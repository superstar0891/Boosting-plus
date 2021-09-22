<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductAddOn extends Model
{
    use HasTranslations;

    protected $table = "product_add_ons";

    protected $fillable = [
        'type',
        'name',
        'price_in_percent',
        'description',
    ];

    public $translatable = ['name', 'description'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function option()
    {
        return $this->hasMany('App\ProductAddOnOption', 'addon_id');
    }
}
