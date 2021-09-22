<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Placement extends Model
{
    use HasTranslations;
    protected $table = "placement_details";

    public $translatable = ['name'];

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
