<?php

namespace App\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable,
        HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'first_name',
        'last_name',
        'email',
        'password',
        'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Place Comment By User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function placeComments()
    {
        return $this->hasMany('App\Http\Models\PlaceComment');
    }

    /**
     * Place Rating By User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function placeRating()
    {
        return $this->hasMany('App\Http\Models\PlaceRating');
    }

    /**
     * Place Suggest By User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function placeSuggest()
    {
        return $this->hasMany('App\Http\Models\Suggest');
    }
}
