<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    public static function boot()
    {
        parent::boot();
        self::creating(function ($order) {
            if ($order->reference === null) {
                $order->reference = "Order";
            }
        });
        self::created(function ($order) {
            if ($order->reference == "Order") {
                $order->reference = "ORD#" . $order->id . 'PR' .  $order->product_id . 'CU' . $order->customer_id;
                $order->save();
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function placement()
    {
        return $this->belongsTo('App\Placement', 'placement_detail_id');
    }

    public function booster()
    {
        return $this->belongsTo('App\User', 'booster_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function lines()
    {
        return $this->hasMany('App\OrderLine');
    }

    public function conversation()
    {
        return $this->hasOne('App\Conversation');
    }

}
