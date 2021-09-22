<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'game_id',
        'price',
        'type',
        'image',
    ];

    public $translatable = ['name', 'short_description', 'description', 'prefered_boost_name'];


    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    public function productAddons()
    {
        return $this->hasMany('App\ProductAddOn')->orderBy('addon_order');
    }
    public function placements()
    {
        return $this->hasMany('App\Placement');
    }

    public function hasDuoQ()
    {
        $hasDuoQ = false;
        foreach($this->productAddons as $addon) {
            if ($addon->is_duo_q == 1) {
                $hasDuoQ = true;
            }
        }
        return $hasDuoQ;
    }

    public function boostPriceSchemes()
    {
        return $this->hasMany('App\BoostPriceScheme');
    }

    public function ranks()
    {
        return $this->hasMany('App\Rank');
    }

    public function calculatePercentPrice($addonPrice, $price)
    {
        return round(($addonPrice / 100) * $price, 2);
    }

    public function getAddedPercent($addonPrice)
    {
        return round(($addonPrice / 100) * $this->price, 2);
    }
}
