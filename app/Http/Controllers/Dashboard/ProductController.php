<?php

namespace App\Http\Controllers\Dashboard;

use App\Game;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAddOn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        return view('dashboard.products.index');
    }

    public function createOrUpdate(Request $request, Product $product)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $product->exists ? "updated" : "created";
        $existingDuoQ = null;
        if ($product->hasDuoQ()) {
            $existingDuoQ = ProductAddOn::where('product_id', $product->id)->where('is_duo_q', 1)->first();
        }
        if ($request->isMethod('post')) {
            $detailEN = $request->input('descriptionEN');
            $detailAR = $request->input('descriptionAR');
            $product_link = $request->input('product_link');
            $domEN = new \domdocument();
            $domAR = new \domdocument();
            $domEN->loadHtml($detailEN, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domAR->loadHtml($detailAR, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $detailEN = $domEN->savehtml();
            $detailAR = utf8_decode($domAR->savehtml($domAR->documentElement));
            $image = $request->file('image');
            $fileName = "";
            if ($image != null) {
                $fileName = time() . '.' . $image->extension();
                $image->move(public_path('dash/images/products'), $fileName);
            }
            return \DB::transaction(function () use ($request, $product, $action, $fileName, $detailEN, $detailAR,$product_link) {
                $product->game_id = Game::query()->where('id', $request->input('game'))->first()->id;
                $product->setTranslation('name', 'en', $request->input('nameEN'));
                $product->product_link = $product_link;
                $product->setTranslation('name', 'ar', $request->input('nameAR'));
                $product->setTranslation('short_description', 'en', $request->input('short_descriptionEN'));
                $product->setTranslation('short_description', 'ar', $request->input('short_descriptionAR'));
                $product->setTranslation('description', 'en', $detailEN);
                $product->setTranslation('description', 'ar', $detailAR);
                if ($request->file('image') != null || $product->image == null)
                    $product->image = $fileName;
                $product->price = $request->input('price') ?? 0;
                if($request->input('boosting_service')) {
                    $product->type = 'Boosting';
                } elseif($request->input('placement_match')) {
                    $product->type = 'Placement';
                } elseif($request->input('rank_system')){
                    $product->type = 'Rank';
                } 
                else {
                    $product->type = null;
                }
                $product->setTranslation('prefered_boost_name', 'en', $request->input('boostingNameEN'));
                $product->setTranslation('prefered_boost_name', 'ar', $request->input('boostingNameAR'));
                $product->placement_maximum_amount_of_matches = $request->input('placement_matches') ?? null;
                $product->matches_text = $request->input('matches_text') ?? null;
                $product->save();
                if ($request->input('duoq_check') == "yes") {
                    if (!$product->hasDuoQ()) {
                        $duoQ = new ProductAddOn();
                        $duoQ->product_id = $product->id;
                        $duoQ->type = "Checkbox";
                        $duoQ->setTranslation('name', 'en', 'Duo-Q');
                        $duoQ->setTranslation('name', 'ar', 'Duo-Q');
                        $duoQ->price_in_percent = $request->input('duoq_price');
                        $duoQ->setTranslation('description', 'en', $request->input('duoq_descriptionEN'));
                        $duoQ->setTranslation('description', 'ar', $request->input('duoq_descriptionAR'));
                        $duoQ->is_duo_q = 1;
                        $duoQ->save();
                    } else {
                        $existingDuoQ = ProductAddOn::where('product_id', $product->id)->where('is_duo_q', 1)->first();
                        $existingDuoQ->price_in_percent = $request->input('duoq_price');
                        $existingDuoQ->setTranslation('description', 'en', $request->input('duoq_descriptionEN'));
                        $existingDuoQ->setTranslation('description', 'ar', $request->input('duoq_descriptionAR'));
                        $existingDuoQ->save();
                    }
                } else {
                    if ($product->hasDuoQ()) {
                        $existingDuoQ = ProductAddOn::where('product_id', $product->id)->where('is_duo_q', 1)->first();
                        $existingDuoQ->delete();
                    }
                }
                //Redirect to the product index page
                return redirect(route('dashboard.products'))->with('success', 'The product has been ' . $action . '.');
            });
        }
        return view('dashboard.products.form', ['games' => Game::all(),
            'product' => $product->exists ? $product : null, //Only send our product if it exists(i.e we're editing it)
            'existingDuoQ' => $existingDuoQ,
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(Product $product)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $product->delete();

        return redirect(route('dashboard.products'))->with('success', 'Product deleted.');
    }
}
