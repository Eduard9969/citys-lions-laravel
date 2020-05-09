<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceRating extends Model
{

    /**
     * @var string
     */
    protected $table = 'place_ratings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'place_id',
        'user_id',
        'rating'
    ];

}
