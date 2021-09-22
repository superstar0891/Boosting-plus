<?php

namespace App\Http\Controllers\Api;

use App\BoostPriceScheme;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $model = Order::query()->with('product', 'customer', 'booster', 'product.game');
        if(Auth::user()->type == "Booster") {
            $model->where('booster_id', Auth::user()->id)->orWhere('booster_id', null);
        } elseif(Auth::user()->type == "Customer") {
            $model->where('customer_id', Auth::user()->id);
        }

        $model->where('status', '!=', 'Initialized')->where('status', '!=', 'Completed');


        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

    public function completedOrders(Request $request)
    {
        $model = Order::query()->with('product', 'customer', 'booster', 'product.game');
        if(Auth::user()->type == "Booster") {
            $model->where('booster_id', Auth::user()->id)->orWhere('booster_id', null);
        } elseif(Auth::user()->type == "Customer") {
            $model->where('customer_id', Auth::user()->id);
        }

        $model->where('status', 'Completed');

        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}
