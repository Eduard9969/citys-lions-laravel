<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PlacePicture extends Model
{

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'place_pictures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_id',
        'alias',
        'is_main',
        'status_id',
    ];

    /**
     * Off main poster By place_id
     *
     * @param $place_id
     * @return mixed
     */
    public function clearMainPoster($place_id)
    {
        return PlacePicture::where('place_id', $place_id)->where('is_main', 1)->update(['is_main' => 0]);
    }

}
