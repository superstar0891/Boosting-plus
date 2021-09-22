<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Placement;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlacementController extends Controller
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
        return view('dashboard.placement.index');
    }

    public function createOrUpdate(Request $request, Placement $placement)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $placement->exists ? "updated" : "created";
        if ($request->isMethod('post')) {
            return \DB::transaction(function () use ($request, $placement, $action) {
                $placement->product_id = $request->input('product');
                $placement->setTranslation('name', 'en', $request->input('nameEN'));
                $placement->setTranslation('name', 'ar', $request->input('nameAR'));
                $placement->price_per_match = $request->input('price_per_match');
                $placement->save();
                $image = $request->file('image');
                $fileName = "";
                $extension = null;
                if ($image != null) {
                    Storage::delete(public_path('dash/images/placement/product/' . $request->input('product') . '/' . $placement->id));
                    $extension = '.' . $image->extension();
                    $fileName = $placement->id . $extension;
                    $image->move(public_path('dash/images/placement/product/' . $request->input('product')), $fileName);
                    $placement->image = $extension;
                    $placement->save();
                }
                //Redirect to the placement index page
                return redirect(route('dashboard.placement'))->with('success', 'The placement has been ' . $action . '.');
            });
        }
        return view('dashboard.placement.form', [
            'products' => Product::query()->where('type', 'Placement')->get(),
            'placement' => $placement->exists ? $placement : null, //Only send our placement if it exists(i.e we're editing it)
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(Placement $placement)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $placement->delete();

        return redirect(route('dashboard.placement'))->with('success', 'Placement deleted.');
    }
}
