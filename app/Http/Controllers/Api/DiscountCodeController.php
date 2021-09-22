<?php

namespace App\Http\Controllers\Api;

use App\DiscountCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiscountCodeController extends Controller
{

    public function index(Request $request)
    {

        $model = DiscountCode::query();
        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}