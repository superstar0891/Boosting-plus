<?php

namespace App\Http\Controllers\Site;

use App\BoostPriceScheme;
use App\Game;
use App\Http\Controllers\Controller;
use App\Placement;
use App\Product;
use App\Rank;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{

    public function view(Game $game, Product $product)
    {
        if ($product->type == "Boosting") {
            $boostSchemeQuery = BoostPriceScheme::query()->where('product_id', $product->id);
            $lowestAmount = $boostSchemeQuery->orderBy('start_range', 'asc')->pluck('start_range')->first();
            $highestAmount = $boostSchemeQuery->orderBy('end_range', 'desc')->pluck('end_range')->last();
            $boostSchemes = $boostSchemeQuery->get();
        } elseif($product->type == "Placement") {
            $placements = Placement::where('product_id', $product->id)->get();
            $matchAmount = $product->placement_maximum_amount_of_matches;
        }

        $ranks_name = Rank::where('product_id',$product->id)->groupBy('name')->orderBy('rank_order','asc')->get();
        ///to get all the levels of lowest rank
        $ranks_level = DB::table("ranks")
          ->select("ranks.*")
          ->join(DB::raw("(Select min(rank_order),name from ranks where product_id='".$product->id." order By rank_order asc') as r2"),function($join){
            $join->on("ranks.name","=","r2.name");
          })
          ->orderBy('rank_order','asc')
          ->get();

        return view('frontend.games.products.view',
            [
                'game' => $game,
                'product' => $product,
                'boostSchemes' => $boostSchemes ?? null,
                'lowestAmount' => $lowestAmount ?? null,
                'highestAmount' => $highestAmount ?? null,
                'matchAmount' => $matchAmount ?? null,
                'placements' => $placements ?? null,
                'ranks_name' => $ranks_name ?? null,
                'ranks_level' => $ranks_level ?? null,
            ]);
    }

    public function product_view(Request $request,$game_link,$product_link)
    {
        $games = Game::all();
        $game = Game::where('game_link',$game_link)->first();
        $product = Product::where('product_link',$product_link)
                            ->where('game_id',$game->id)
                            ->first();

        if ($product->type == "Boosting") {
            $boostSchemeQuery = BoostPriceScheme::query()->where('product_id', $product->id);
            $lowestAmount = $boostSchemeQuery->orderBy('start_range', 'asc')->pluck('start_range')->first();
            $highestAmount = $boostSchemeQuery->orderBy('end_range', 'desc')->pluck('end_range')->last();
            $boostSchemes = $boostSchemeQuery->get();
        } elseif($product->type == "Placement") {
            $placements = Placement::where('product_id', $product->id)->get();
            $matchAmount = $product->placement_maximum_amount_of_matches;
        }
        $ranks_level = array();
        $ranks_name = Rank::where('product_id',$product->id)->groupBy('name')->orderBy('rank_order','asc')->get();
        if(count($ranks_name)>0){
        $cnt=1;
        foreach($ranks_name as $single_rank){
            if($cnt==1){
            $lowest_rank_name = $single_rank->name;
        }
        $cnt++;
        }
        $ranks_level = Rank::where('product_id',$product->id)
                           ->where('name',$lowest_rank_name)
                           ->orderBy('rank_order','asc')
                           ->get();
    }
        ///to get all the levels of lowest rank

        // $ranks_level = DB::table("ranks")
        //   ->select("ranks.*")
        //   ->join(DB::raw("(Select min(rank_order),name from ranks where product_id='".$product->id."' order By rank_order asc) as r2"),function($join){
        //     $join->on("ranks.name","=","r2.name");
        //   })
        //   ->orderBy('rank_order','asc')
        //   ->get();
          // dd($ranks_level);
        return view('frontend.games.products.view',
            [
                'games' => $games,
                'game' => $game,
                'product' => $product,
                'boostSchemes' => $boostSchemes ?? null,
                'lowestAmount' => $lowestAmount ?? null,
                'highestAmount' => $highestAmount ?? null,
                'matchAmount' => $matchAmount ?? null,
                'placements' => $placements ?? null,
                'ranks_name' => $ranks_name ?? null,
                'ranks_level' => $ranks_level ?? null,
            ]);
    }
}
