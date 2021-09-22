<?php

namespace App\Http\Controllers\Api;

use App\BoostPriceScheme;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $model = User::query()->where('type', 'Customer');

        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}