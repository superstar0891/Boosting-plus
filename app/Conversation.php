<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Conversation extends Model
{

    protected $fillable = [
        'customer_id',
        'booster_id',
        'order_id',
        'is_active',
        'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function booster()
    {
        return $this->belongsTo('App\User', 'booster_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function messages()
    {
        return $this->hasMany('App\ConversationMessage');
    }

    public static function startChat(Order $order)
    {
        $existingConversation = Conversation::query()->where('order_id', $order->id)->first();
        if ($existingConversation == null) {
            $conversation = new Conversation();
            $conversation->customer_id = $order->customer_id;
            $conversation->booster_id = $order->booster_id;
            $conversation->order_id = $order->id;
            $conversation->is_active = 1;
            $conversation->save();
        }
    }

}
