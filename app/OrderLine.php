<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{

    protected $table = "order_lines";
    protected $fillable = [
        'order_id',
        'addon_id',
        'addon_type_id',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function addon()
    {
        return $this->belongsTo('App\ProductAddOn', 'addon_id');
    }
    public function addonOption()
    {
        return $this->belongsTo('App\ProductAddOnOption', 'addon_type_id');
    }
}
