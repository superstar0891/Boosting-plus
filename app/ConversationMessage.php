<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ConversationMessage extends Model
{

    protected $fillable = [
        'conversation_id',
        'message',
        'sender_id',
        'created_at',
    ];

    public function conversation()
    {
        return $this->belongsTo('App\Conversation');
    }

    public function sender()
    {
        return $this->belongsTo('App\User');
    }
}
