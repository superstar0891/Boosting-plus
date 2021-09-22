<?php

namespace App\Http\Controllers\Dashboard;

use App\Rank;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class RankController extends Controller
{
  public function index()
  {
      if (Auth::user()->type != "Administrator") {
          return abort(404);
      }
      return view('dashboard.rank.index');
  }


  public function create(Request $request)
  {
      if (Auth::user()->type != "Administrator") {
          return abort(404);
      }

      if ($request->isMethod('post')) {

          $productID = Product::query()->where('id', $request->input('product'))->first()->id;

          $counter = count($request->input('counter'));

            for($i=0;$i<$counter;$i++){
              $endFileName="";
              $image = null;
              if(isset($request->file('image')[$i])) {
                $image = $request->file('image')[$i];
              }
              $endExtension = null;
              if ($image != null) {
                  $endExtension = '.' . $image->extension();
                  $endFileName = rand() . $endExtension;
                  $image->move(public_path('dash/images/rank/' . $productID . '/'), $endFileName);
              }

              DB::transaction(function () use ($request, $productID, $i,$endFileName) {
                  $my_rank = new Rank();
                  $my_rank->product_id = $productID;
                  $my_rank->name = $request->input('name')[$i];
                  $my_rank->level = $request->input('level')[$i];
                  if ($endFileName !== null) {
                      $my_rank->image = $endFileName;
                  }
                  $my_rank->price = $request->input('price')[$i];
                  $my_rank->rank_order = $request->input('rank_order')[$i];
                  $my_rank->save();
                  //Redirect to the product index page
              });

            }
            return redirect(route('dashboard.ranks'))->with('success', 'The rank has been Created.');
      }
      return view('dashboard.rank.form', [
          'products' => Product::query()->get(),
          'action' => "Creating", //May aswell send the view what we're actually doing too!
      ]);
  }


  ///function to edit ranks of a product/////
  // $rec_id is id of product, on that basis all of the ranks of the products will be fetched
  public function update(Request $request,$rec_id)
  {
      if (Auth::user()->type != "Administrator") {
          return abort(404);
      }
      //get info about the product
      $product = Product::query()->where('id', $rec_id)->first();

        if ($request->isMethod('post')) {
          $productID = $request->input('product_id');
          // counter for already existing ranks starts
          $counter = count($request->input('counter'));
          for($i=0;$i<$counter;$i++){

          /////////////////images//////////////////////////
          $endFileName="";
          $image = null;
          if(isset($request->file('image')[$i])) {
            $image = $request->file('image')[$i];
          }
          $endExtension = null;
          if ($image != null) {
              $endExtension = '.' . $image->extension();
              $endFileName = rand() . $endExtension;
                if($request->input('old_image')[$i]!=null){
                  unlink(public_path('dash/images/rank/' . $productID . '/' . $request->input('old_image')[$i]));
                }
              $image->move(public_path('dash/images/rank/' . $productID . '/'), $endFileName);
          }else{
            $endFileName = $request->input('old_image')[$i];
          }
          /////////////////images//////////////////////////
            DB::transaction(function () use ($request, $i,$endFileName) {
                $update_rank = array();
                $update_rank['name'] = $request->input('name')[$i];
                $update_rank['level'] = $request->input('level')[$i];
                $update_rank['image'] = $endFileName;
                $update_rank['price'] = $request->input('price')[$i];
                $update_rank['rank_order'] = $request->input('rank_order')[$i];
                Rank::where('id',$request->input('rank_id')[$i])->update($update_rank);

            });
          }
          // counter for already existing ranks starts

          //counter for new ranks adding to the product
            if($request->input('counter_new')) {
              $new_counter = count($request->input('counter_new'));
              for($i=0;$i<$new_counter;$i++){
                $endFileName="";
                $image = null;
                if(isset($request->file('image_new')[$i])) {
                  $image = $request->file('image_new')[$i];
                }
                $endExtension = null;
                if ($image != null) {
                    $endExtension = '.' . $image->extension();
                    $endFileName = rand() . $endExtension;
                    $image->move(public_path('dash/images/rank/' . $productID . '/'), $endFileName);
                }

                DB::transaction(function () use ($request, $productID, $i,$endFileName) {
                    $my_rank = new Rank();
                    $my_rank->product_id = $productID;
                    $my_rank->name = $request->input('name_new')[$i];
                    $my_rank->level = $request->input('level_new')[$i];
                    if ($endFileName !== null) {
                        $my_rank->image = $endFileName;
                    }
                    $my_rank->price = $request->input('price_new')[$i];
                    $my_rank->rank_order = $request->input('rank_order_new')[$i];
                    $my_rank->save();
                    //Redirect to the product index page
                });

              }
          }
          //counter for new ranks adding to the product

        }
      $all_ranks = Rank::where('product_id',$rec_id)->get();
      return view('dashboard.rank.form_edit', [
          'all_ranks' => $all_ranks,
          'product' => $product,
          'action' => "Updating", //May aswell send the view what we're actually doing too!
      ]);
  }

  ////function for ajax delete rank////
  function ajax_delete(Request $request){
    $rank_id = $request->input('rank_id');
    $rank_info = Rank::where('id',$rank_id)->first();
    if($rank_info->image != null ){
      unlink(public_path('dash/images/rank/' . $rank_info->product_id . '/' . $rank_info->image));
    }
    Rank::where('id',$rank_id)->delete();
    return 200;
  }

  //function for delete all ranks of a products
  public function delete(Request $request , $id)
  {
      if (Auth::user()->type != "Administrator") {
          return abort(404);
      }

      $all_ranks = Rank::where('product_id',$id)->get();
      foreach($all_ranks as $single_rank){
        if($single_rank->image != null){
          unlink(public_path('dash/images/rank/' . $single_rank->product_id . '/' . $single_rank->image));
        }
      }
      Rank::where('product_id',$id)->delete();
      return redirect(route('dashboard.ranks'))->with('success', 'Ranks deleted.');
  }
}
