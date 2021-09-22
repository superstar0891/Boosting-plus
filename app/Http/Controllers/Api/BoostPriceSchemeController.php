<?php

namespace App\Http\Controllers\Api;

use App\BoostPriceScheme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BoostPriceSchemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $model = BoostPriceScheme::query()->with('product', 'product.game');

        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}