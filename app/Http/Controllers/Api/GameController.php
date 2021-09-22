<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{

    public function index(Request $request)
    {

        $model = Game::query();
        return DataTables::eloquent($model)
            ->smart(true)
            ->toJson();
    }

}