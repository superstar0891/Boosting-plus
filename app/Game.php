<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Game extends Model
{
    use HasTranslations;

    protected $fillable = [
        'game_name',
        'description',
        'image',
    ];


    public $translatable = ['description'];
}
