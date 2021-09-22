<?php

namespace App\Http\Controllers\Dashboard;

use App\Game;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAddOn;
use App\ProductAddOnOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAddonController extends Controller
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
        return view('dashboard.productaddons.index');
    }

    public function createOrUpdate(Request $request, ProductAddOn $addon)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $addon->exists ? "updated" : "created";

        if ($request->isMethod('post')) {
            return \DB::transaction(function () use ($request, $addon, $action) {
                $addon->product_id = Product::query()->where('id', $request->input('product'))->first()->id;
                $addon->setTranslation('name', 'en', $request->input('nameEN'));
                $addon->setTranslation('name', 'ar', $request->input('nameAR'));
                $addon->price_in_percent = $request->input('price');
                $addon->setTranslation('description', 'en', $request->input('descriptionEN'));
                $addon->setTranslation('description', 'ar', $request->input('descriptionAR'));
                $addon->addon_order = $request->input('addon_order');
                $addon->hide_price = $request->input('hide_price');
                $addon->required_field = $request->input('required_field');
                $addon->save();
                if ($action == "created") { //if we're creating

                    $type = $request->input('type');
                    if ($type == "Radio Options") {
                        for($i = 0; $i < $request->input('radioOptionAmount'); $i++) {
                            $number = $i + 1;
                            $addonOption = new ProductAddOnOption();
                            $addonOption->addon_id = $addon->id;
                            $addonOption->value = $request->input('option-' . $number);
                            $addonOption->save();
                        }
                    }
                    if ($type == "Drop Down") {
                        for($i = 0; $i < $request->input('ddOptionAmount'); $i++) {
                            $number = $i + 1;
                            $addonOption = new ProductAddOnOption();
                            $addonOption->addon_id = $addon->id;
                            $addonOption->value = $request->input('ddoption-' . $number);
                            $addonOption->amount = $request->input('ddvalue-' . $number);
                            $addonOption->save();
                        }
                    }
                    $addon->type = $request->input('type');

                }
                $addon->save();
                //Redirect to the product index page
                return redirect(route('dashboard.productaddons'))->with('success', 'The product addon has been ' . $action . '.');
            });
        }
        return view('dashboard.productaddons.form', [
            'products' => Product::all(),
            'addon' => $addon->exists ? $addon : null, //Only send our addon if it exists(i.e we're editing it)
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(ProductAddOn $addon)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $addon->delete();

        return redirect(route('dashboard.productaddons'))->with('success', 'Product deleted.');
    }
}
