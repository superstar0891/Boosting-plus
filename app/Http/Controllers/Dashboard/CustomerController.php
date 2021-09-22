<?php

namespace App\Http\Controllers\Dashboard;

use App\Game;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
        return view('dashboard.customers.index');
    }

    public function delete(User $customer)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $customer->delete();

        return redirect(route('dashboard.customers'))->with('success', 'Customer Deleted.');
    }
}
