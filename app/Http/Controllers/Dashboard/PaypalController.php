<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\DiscountCode;
use App\Order;
use App\OrderLine;
use App\Placement;
use App\Product;
use App\ProductAddOn;
use App\ProductAddOnOption;
use App\User;
use App\Rank;
use Auth;
use Config;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str as StringHelper;
use NZTim\Mailchimp\Mailchimp;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\InputFields;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Str;
use Throwable;
use URL;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        // Main configuration in constructor
        $paypalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret'])
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function checkout(HttpRequest $request, Product $product)
    {
      //////////rank system////////
      $new_amount = 0;
      $current_title = "";
      $desired_title = "";
      $current_rank = "";
      $desired_rank = "";
      if($request->input('current_rank_name')){
        $current_rank = $request->input('current_rank_name');
      }
      if($request->input('current_rank_level')){
        $current_rank = $request->input('current_rank_level');
      }
      if($request->input('desired_rank_name')){
        $desired_rank = $request->input('desired_rank_name');
      }
      if($request->input('desired_rank_level')){
        $desired_rank = $request->input('desired_rank_level');
      }
      ///check current and desired rank exists and current is less than desired
      if($current_rank != "" && $desired_rank != "" && ($current_rank < $desired_rank)) {
        $current_rank_array = Rank::where('id',$current_rank)->first();
        $desired_rank_array = Rank::where('id',$desired_rank)->first();

        $current_title = $current_rank_array->name."-".$current_rank_array->level;
        $desired_title = $desired_rank_array->name."-".$desired_rank_array->level;

        $all_prices = Rank::whereBetween('rank_order',[$current_rank_array->rank_order,$desired_rank_array->rank_order])
                          ->where('product_id',$product->id)
                          ->get();
        foreach($all_prices as $single_price){
          $new_amount += $single_price->price;
        }
      }
      //////////rank system////////

        $possibleAddonsRadios = ProductAddOn::query()->where('product_id', $product->id)->where('type', 'Radio Options')->get();
        $possibleAddonsdd = ProductAddOn::query()->where('product_id', $product->id)->where('type', 'Drop Down')->get();
        $customerCheck = User::query()->where('type', 'customer')->where('email', $request->input('email'))->first();
        $boostLevelCurrent = $request->input('boostRangeCurrent');
        $boostLevelDesired = $request->input('boostRangeDesired');
        $placementRank = $request->input('placementSelect');
        $placementMatchAmount = $request->input('match-amount');
        if ($customerCheck == null) {
            $randomString = \Illuminate\Support\Str::random();
            $customer = new User();
            $customer->name = $request->input('email');
            $customer->email = $request->input('email');
            $customer->password = Hash::make($randomString);
            $customer->type = 'Customer';
            if ($request->input('marketing_list') == "yes") {
                $customer->gives_marketing_consent = 1;
                try {
                    Mailchimp::subscribe('558e2ba180', $request->input('email'), [], false);
                } catch (Throwable $e) {
                    // API call failed - user was not subscribed
                    // Log the error information for debugging
                    Log::error($e->getMessage());
                    // Then return error message to user
                }
            } else {
                $customer->gives_marketing_consent = null;
            }
            $customer->save();
            $credentials = ['email' => $customer->email];
            Password::sendResetLink($credentials, function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
        } else {
            $customer = $customerCheck;
        }
        $promoCode = null;
        $codeObject = DiscountCode::query()->where('code', $request->input('promo_code'))->first();
        if ($codeObject != null) {
            $promoCode = $request->input('promo_code');
        }
        // We initialize the payer object and set the payment method to PayPal
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // We insert a new order in the order table with the 'initialised' status
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->booster_id = null;
        $order->product_id = $product->id;
        $order->status = 'Initialized';
        $order->game_system = $request->input('platform');
        $order->login_email = $request->input('platform_email');
        $order->login_username = $request->input('platform_username');
        $order->login_password = $request->input('platform_password');
        $order->payment_method = 'Paypal';
        $order->promo_code = $promoCode;
        $order->notes = $request->input('order_notes');
        $order->booster_paid = 0;
        if ($product->type == "Boosting") {
            $order->boost_current_level = $boostLevelCurrent;
            $order->boost_desired_level = $boostLevelDesired;
        } elseif($product->type == "Placement") {
            $order->amount_of_matches = $placementMatchAmount;
            $order->placement_detail_id = $placementRank;
        }
        $order->current_rank = $current_title;
        $order->desired_rank = $desired_title;
        $order->rank_price = $new_amount;
        $order->save();
        // dd($order);
        // We need to update the order if the payment is complete, so we save it to the session
        Session::put('orderId', $order->getKey());
        $totalBoostPrice = 0;
        $totalPrice = $product->price;
        $isInSameScheme = false; //This way we can handle whether the levels are within the same boostpricescheme range
        $items = [];
        if ($boostLevelDesired != null && $boostLevelCurrent != null) {
            $totalPrice = 0;
            $counter = 0;
            $sameLevelPrice = 0;
            $lowerLevelInRangePrice = 0;
            $higherLevelInRangePrice = 0;
            foreach ($product->boostPriceSchemes as $boost) {
                if ($boostLevelCurrent >= $boost->start_range && $boostLevelDesired <= $boost->end_range ) { //If we're in the same range
                    $totalBoostPrice = ($boostLevelDesired - $boostLevelCurrent) * $boost->price_per_level;
                    break;
                } else {
                    if ($boostLevelDesired > $boost->end_range && $boostLevelCurrent < $boost->start_range) { //
                        $counter += $boost->price_per_level * ($boost->end_range - $boost->start_range);
                    } else {
                        if ($boostLevelCurrent >= $boost->start_range && $boostLevelCurrent <= $boost->end_range) {
                            $lowerLevelInRangePrice = ($boost->end_range - $boostLevelCurrent) * $boost->price_per_level;
                        }
                        if ($boostLevelDesired >= $boost->start_range && $boostLevelDesired <= $boost->end_range) {
                            $higherLevelInRangePrice = ($boostLevelDesired - $boost->start_range) * $boost->price_per_level;
                        }
                    }
                    $finalNumber = 0;
                    $finalNumber = $lowerLevelInRangePrice + $higherLevelInRangePrice + $counter;
                    if ($finalNumber !== 0) {
                        $totalBoostPrice = $finalNumber;
                    }
                }

            }
            $boostItem = new Item();
            $boostItem->setName('Level Boosting');
            $boostItem->setCurrency('USD');
            $boostItem->setQuantity(1);
            $boostItem->setPrice($totalBoostPrice);
            $items[] = $boostItem;
            $totalPrice += $totalBoostPrice;
        }
        $placementPrice = 0;
        if ($placementRank != null) {
            $placement = Placement::query()->where('id', $placementRank)->firstOrFail();
            $placementPrice = $placement->price_per_match * $placementMatchAmount;
            $placementItem = new Item();
            $placementItem->setName($placement->name . " - " . $placementMatchAmount . ' Matches');
            $placementItem->setCurrency('USD');
            $placementItem->setQuantity(1);
            $placementItem->setPrice($placementPrice);
            $items[] = $placementItem;
            $totalPrice += $placementPrice;
        }
        if($current_rank!="" && $desired_rank!=""){
            $rankItem = new Item();
            $rankItem->setName('Rank Boosting');
            $rankItem->setCurrency('USD');
            $rankItem->setQuantity(1);
            $rankItem->setPrice($new_amount);
            $items[] = $rankItem;
            $totalPrice += $new_amount;
      }
        foreach ($possibleAddonsRadios as $addon) {
            if ($request->input('radioOptions-' . $addon->id) != null) {
                $line = new OrderLine();
                $line->order_id = $order->id;
                $line->addon_id = $addon->id;
                $line->addon_type_id = ProductAddOnOption::query()->where('value', $request->input('radioOptions-' . $addon->id))->firstOrFail()->id;
                if ($totalBoostPrice != 0) {
                    $line->price = $product->calculatePercentPrice($addon->price_in_percent, $totalBoostPrice);
                } elseif ($placementPrice != 0) {
                    $line->price = $product->calculatePercentPrice($addon->price_in_percent, $placementPrice);
                } elseif ($product->type=="Rank") {
                    $line->price = $product->calculatePercentPrice($addon->price_in_percent, $new_amount);
                } else {
                    $line->price = $product->getAddedPercent($addon->price_in_percent);
                }
                $line->save();
            }
        }

        foreach ($possibleAddonsdd as $addon) {
            if ($request->input('ddOptions-' . $addon->id) != "") {
              $new_addon = ProductAddOnOption::query()->where('id', $request->input('ddOptions-' . $addon->id))->first();
                $line = new OrderLine();
                $line->order_id = $order->id;
                $line->addon_id = $addon->id;
                $line->addon_type_id =$new_addon->id;
                ////////////
                    if ($totalBoostPrice != 0) {
                    $line->price = $product->calculatePercentPrice($new_addon->amount, $totalBoostPrice);
                } elseif ($placementPrice != 0) {
                    $line->price = $product->calculatePercentPrice($new_addon->amount, $placementPrice);
                } elseif ($product->type=="Rank") {
                    $line->price = $product->calculatePercentPrice($new_addon->amount, $new_amount);
                } else {
                    $line->price = $product->getAddedPercent($new_addon->amount);
                }
                ////////////
                $line->save();
            }
        }

        if ($request->input('addon-text')) {
            foreach ($request->input('addon-text') as $id => $textField) {
                if ($textField != null) {
                    foreach ($request->input('addon-text') as $id => $textField) {
                        $addon = ProductAddOn::query()->where('id', $id)->firstOrFail();
                        $line = new OrderLine();
                        $line->order_id = $order->id;
                        $line->addon_id = $addon->id;
                        $line->text_input = $textField;
                        if ($totalBoostPrice != 0) {
                            $line->price = $product->calculatePercentPrice($addon->price_in_percent, $totalBoostPrice);
                        } elseif ($placementPrice != 0) {
                            $line->price = $product->calculatePercentPrice($addon->price_in_percent, $placementPrice);
                        } elseif ($product->type=="Rank") {
                            $line->price = $product->calculatePercentPrice($addon->price_in_percent, $new_amount);
                        }
                        else {
                            $line->price = $product->getAddedPercent($addon->price_in_percent);
                        }
                        $line->save();
                    }
                }
            }
        }
        if ($request->input('addon-number')) {
            foreach ($request->input('addon-number') as $id => $numberField) {
                if ($numberField != null) {
                    $addon = ProductAddOn::query()->where('id', $id)->firstOrFail();
                    $line = new OrderLine();
                    $line->order_id = $order->id;
                    $line->addon_id = $addon->id;
                    $line->number_input = $numberField;
                    if ($totalBoostPrice != 0) {
                        $line->price = $product->calculatePercentPrice($addon->price_in_percent, $totalBoostPrice);
                    } elseif ($placementPrice != 0) {
                        $line->price = $product->calculatePercentPrice($addon->price_in_percent, $placementPrice);
                    } elseif ($product->type=="Rank") {
                        $line->price = $product->calculatePercentPrice($addon->price_in_percent, $new_amount);
                    }
                    else {
                        $line->price = $product->getAddedPercent($addon->price_in_percent);
                    }
                    $line->save();
                }
            }
        }
        if ($request->input('addon-checkbox')) {
            foreach ($request->input('addon-checkbox') as $id => $checkbox) {
                $addon = ProductAddOn::query()->where('id', $id)->firstOrFail();
                $line = new OrderLine();
                $line->order_id = $order->id;
                $line->addon_id = $addon->id;
                if ($totalBoostPrice != 0) {
                    $line->price = $product->calculatePercentPrice($addon->price_in_percent, $totalBoostPrice);
                } elseif ($placementPrice != 0) {
                    $line->price = $product->calculatePercentPrice($addon->price_in_percent, $placementPrice);
                } elseif ($product->type=="Rank") {
                    $line->price = $product->calculatePercentPrice($addon->price_in_percent, $new_amount);
                }
                else {
                    $line->price = $product->getAddedPercent($addon->price_in_percent);
                }
                $line->save();
            }
        }
        foreach ($order->lines as $item) {
            $newItem = new Item();
            $newItem->setName($item->addon->name);
            $newItem->setCurrency('USD');
            $newItem->setQuantity(1);
            $newItem->setPrice($item->price);
            $items[] = $newItem;
            $totalPrice += $item->price;
        }
        if ($totalBoostPrice == 0 && $placementPrice == 0) {
            $productItem = new Item();
            $productItem->setName($product->name);
            $productItem->setCurrency('USD');
            $productItem->setQuantity(1);
            $productItem->setPrice($product->price);
            $items[] = $productItem;
        }
        if ($codeObject != null) {
            $discountedPrice = round($totalPrice * $codeObject->percentage_discount / 100);
            $discountItem = new Item();
            $discountItem->setName($promoCode . ' Discount Code');
            $discountItem->setCurrency('USD');
            $discountItem->setQuantity(1);
            $discountItem->setPrice(-$discountedPrice);
            $items[] = $discountItem;
            $totalPrice -= $discountedPrice;
        }


        $order->total_payment_amount = round($totalPrice, 2);
        $order->save();

        // We create a new item list and assign the items to it
        $itemList = new ItemList();
        $itemList->setItems($items);

        // Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);
        $createProfile = $webProfile->create($this->apiContext);
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(round($totalPrice, 2));

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction
            ->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions([$transaction]);
        $payment->setExperienceProfileId($createProfile->getId());
        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();

                break;
            }
        }

        // We store the payment ID into the session
        Session::put('paypalPaymentId', $payment->getId());
        Session::put('total', $totalPrice);

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        //TODO: Double check the below redirect is for errors?
        return Redirect::to('/')->with('error', 'There was a problem processing your payment. Please contact support.');
    }

    public function getPaymentStatus()
    {
        $paymentId = Session::get('paypalPaymentId');
        $orderId = Session::get('orderId');
        $total = Session::get('total');

        // We now erase the payment ID from the session to avoid fraud
        Session::forget('paypalPaymentId');

        // If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(FacadeRequest::get('PayerID')) || empty(FacadeRequest::get('token'))) {
            return Redirect::to('/')->with('error', 'There was a problem processing your payment. Please contact support.');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(FacadeRequest::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);
        // Payment is processing but may still fail due e.g to insufficient funds
        $order = Order::find($orderId);
        $order->status = 'processing';

        if ($result->getState() == 'approved') {
            // We also update the order status
            $transactions = $result->getTransactions();
            $relatedResources = $transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $order->status = 'Pending';
            $order->total_payment_amount = $sale->getAmount()->getTotal();
            $order->payee_email = $result->getPayer()->payer_info->email;
            $order->payee_first_name = $result->getPayer()->payer_info->first_name;
            $order->payee_last_name = $result->getPayer()->payer_info->last_name;
            $order->payee_payer_id = $result->getPayer()->payer_info->payer_id;
            $order->payee_country_code = $result->getPayer()->payer_info->country_code;
            $order->payee_business_name = $result->getPayer()->payer_info->business_name;
            $order->payee_receipt_id = $sale->getReceiptId();
            $order->payee_transaction_id = $sale->getId();
            $order->payee_ip = FacadeRequest::ip();
            $order->save();

            Session::flash('success');
            return Redirect::to('thankYou');
        }

        return Redirect::to('/')->with('error', 'There was a problem processing your payment. Please contact support.');
    }
}
