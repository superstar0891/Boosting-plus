<?php

namespace App\Http\Controllers\Api;

use App\Rank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RankController extends Controller
{
  public function __construct()
  {

  }

  public function index(Request $request)
  {
      $this->middleware('auth');
      $model = Rank::query()->with('product', 'product.game')->groupBy('ranks.product_id');

      // dd($model);
      return DataTables::eloquent($model)
          ->smart(true)
          ->toJson();
  }

  public function get_level_via_rankname(Request $request){
    $current_val = $request->input('current_val');
    $product_id = $request->input('product_id');
    $get_levels = Rank::where('name',$current_val)
                      ->where('level','!=',"")
                      ->where('product_id',$product_id)
                      ->orderBy('rank_order','desc')->get();
    if(count($get_levels)>0){
      return $get_levels;
    }else{
      return "No data";
    }
  }

  public function get_rank_price(Request $request){
    $start_rank = $request->input('start_rank');
    $end_rank = $request->input('end_rank');
    $get_starting_data = Rank::where('id',$start_rank)->first();

    $get_end_data = Rank::where('id',$end_rank)->first();
    $start_img = $get_starting_data['image'];
    $end_image = $get_end_data['image'];
    $amount = 0;
    if($get_starting_data->rank_order < $get_end_data->rank_order){

        $all_prices = Rank::whereBetween('rank_order',[$get_starting_data->rank_order,$get_end_data->rank_order])
                          ->where('product_id',$get_starting_data->product_id)
                          ->get();
        if(count($all_prices)>0){
          foreach($all_prices as $single_price){
            $amount += $single_price->price;
          }
        }
    }
    $ret_array = array("start_img"=>$start_img,"end_img"=>$end_image,"amount"=>$amount);
    return $ret_array;
  }
}
