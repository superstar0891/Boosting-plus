<?php

namespace App\Http\Controllers\Site;

use App\Game;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class GameController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $games = Game::all();
        $latestGame = Game::latest()->first();
        return view('frontend.games',
            [
                'games' => $games,
                'latestGame' => $latestGame
            ]
        );
    }

    public function view(Game $game)
    {
        $products = Product::query()->where('game_id', $game->id)->get();
        return view('frontend.games.view',
            [
                'game' => $game,
                'products' => $products,
            ]);
    }

    public function game_view(Request $request, $game_link)
    {
        $games = Game::all();

        // dd($game_link);
        // exit;
        $game = Game::where('game_link',$game_link)->first();
        // var_dump($game_link);
        // exit;
        // dd($game_link);
        $products = Product::query()->where('game_id', $game->id)->get();


        if($game_link  == 'overwatch') {

            return view('frontend.games.Overwatch_view',
                [
                    'games' => $games,
                    'game' => $game,
                    'products' => $products,

                ]);
        }
        if($game_link == 'Apex Legends') {

            return view('frontend.games.Apex_view',
                [
                    'games' => $games,
                    'game' => $game,
                    'products' => $products,
                ]);
        }
        if($game_link == 'League of legends') {

            return view('frontend.games.Lol_view',
                [
                    'games' => $games,
                    'game' => $game,
                    'products' => $products,
                ]);
        }
        if($game_link == 'Call of duty CW') {

            return view('frontend.games.CCW_view',
                [
                    'games' => $games,
                    'game' => $game,
                    'products' => $products,
                ]);
        }
        if($game_link == 'Call of duty MW') {

            return view('frontend.games.CMW_view',
                [
                    'games' => $games,
                    'game' => $game,
                    'products' => $products,
                ]);
        }
        if($game_link == 'Valorant') {

            return view('frontend.games.Valorant_view',
                [
                    'games' => $games,
                    'game' => $game,
                    'products' => $products,
                ]);
        }
    }
}
