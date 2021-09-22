<?php

namespace App\Http\Controllers\Dashboard;

use App\BoostPriceScheme;
use App\Game;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAddOn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BoostPriceSchemeController extends Controller
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
        return view('dashboard.boostpricescheme.index');
    }

    public function createOrUpdate(Request $request, BoostPriceScheme $scheme)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $scheme->exists ? "updated" : "created";

        if ($request->isMethod('post')) {
            $productID = Product::query()->where('id', $request->input('product'))->first()->id;
            $start_image = $request->file('start_image');
            $startExtension = null;
            if ($start_image != null) {
                $startExtension = '.' . $start_image->extension();
            }
            if ($start_image != null) {
                Storage::delete(public_path('dash/images/boosting/product/' . $productID . '/startrange/' . $scheme->start_range));
                $startFileName = $request->input('start_range') . $startExtension;
                $start_image->move(public_path('dash/images/boosting/product/' . $productID . '/startrange'), $startFileName);
            }
            $end_image = $request->file('end_image');
            $endExtension = null;
            if ($end_image != null) {
                $endExtension = '.' . $end_image->extension();
            }
            if ($end_image != null) {
                Storage::delete(public_path('dash/images/boosting/product/' . $productID . '/endrange/' . $scheme->end_range));
                $endFileName = $request->input('end_range') . $endExtension;
                $end_image->move(public_path('dash/images/boosting/product/' . $productID . '/endrange'), $endFileName);
            }
            return \DB::transaction(function () use ($request, $scheme, $action, $productID, $startExtension, $endExtension) {
                $scheme->product_id = $productID;
                $scheme->start_range = $request->input('start_range');
                $scheme->end_range = $request->input('end_range');
                if ($startExtension !== null) {
                    $scheme->start_image = $startExtension;
                }
                if ($endExtension !== null) {
                    $scheme->end_image = $endExtension;
                }
                $scheme->price_per_level = $request->input('price_per_level');
                $scheme->save();
                //Redirect to the product index page
                return redirect(route('dashboard.boostpricescheme'))->with('success', 'The price scheme has been ' . $action . '.');
            });
        }
        return view('dashboard.boostpricescheme.form', [
            'products' => Product::query()->where('type', 'Boosting')->get(),
            'scheme' => $scheme->exists ? $scheme : null, //Only send our scheme if it exists(i.e we're editing it)
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(BoostPriceScheme $scheme)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $scheme->delete();

        return redirect(route('dashboard.boostpricescheme'))->with('success', 'Price Scheme deleted.');
    }
}
