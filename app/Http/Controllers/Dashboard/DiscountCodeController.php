<?php

namespace App\Http\Controllers\Dashboard;

use App\DiscountCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
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
        return view('dashboard.discountcodes.index');
    }

    public function createOrUpdate(Request $request, DiscountCode $discountCode)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $discountCode->exists ? "updated" : "created";

        if ($request->isMethod('post')) {
            return \DB::transaction(function () use ($request, $discountCode, $action) {
                $discountCode->code = $request->input('code');
                $discountCode->percentage_discount = $request->input('percentage_discount');
                $discountCode->save();
                //Redirect to the game index page
                return redirect(route('dashboard.discountcodes'))->with('success', 'The discount code has been ' . $action . '.');
            });
        }
        return view('dashboard.discountcodes.form', [
            'discountcode' => $discountCode->exists ? $discountCode : null, //Only send our game if it exists(i.e we're editing it)
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(DiscountCode $discountCode)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $discountCode->delete();

        return redirect(route('dashboard.discountcodes'))->with('success', 'Discount Code deleted.');
    }
}
