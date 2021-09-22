<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $model = Product::query()->with('game');
        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}