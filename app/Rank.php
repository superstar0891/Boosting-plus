<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
  protected $fillable = [
      'name',
      'level',
      'rank_order',
      'image',
  ];

  public function product()
  {
      return $this->belongsTo('App\Product');
  }
  
}
