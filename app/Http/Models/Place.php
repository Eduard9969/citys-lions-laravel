<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'features',
        'status_id'
    ];

    /**
     * Get Place Posters
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posters()
    {
        return $this->hasMany('App\Http\Models\PlacePicture');
    }

    /**
     * Get Place Comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Http\Models\PlaceComment');
    }

    /**
     * Get Place Ratings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rating()
    {
        return $this->hasMany('App\Http\Models\PlaceRating');
    }
}
