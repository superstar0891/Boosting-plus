<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class BoostPriceScheme extends Model
{
    protected $table = "boost_price_scheme";

    protected $fillable = [
        'start_range',
        'end_range',
        'price_per_level',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
