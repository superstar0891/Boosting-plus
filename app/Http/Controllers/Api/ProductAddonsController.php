<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductAddOn;
use Illuminate\Http\Request;
use App\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductAddonsController extends Controller
{

    public function index(Request $request)
    {

        $model = ProductAddOn::query()->with('product', 'product.game');
        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}
