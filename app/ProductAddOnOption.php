<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAddOnOption extends Model
{
    protected $table = "product_addons_type_options";

    protected $fillable = [
        'value',
    ];

    public function addon()
    {
        return $this->belongsTo('App\ProductAddOn', 'addon_id');
    }
}
