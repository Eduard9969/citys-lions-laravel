<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'place_proposals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_id',
        'user_id',
        'name',
        'description',
        'features',
        'status_id'
    ];

    /**
     * Get Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function author()
    {
        return $this->hasMany('App\Http\Models\User', 'id', 'user_id');
    }
}
