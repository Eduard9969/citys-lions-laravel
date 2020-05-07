<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceComment extends Model
{


    protected $table = 'place_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_id',
        'user_id',
        'comment'
    ];

}
