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

    /**
     * Author comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    /**
     * Place comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo('App\Http\Models\Place');
    }
}
