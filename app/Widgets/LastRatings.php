<?php

namespace App\Widgets;

use App\Http\Models\Place;
use App\Http\Models\PlaceRating;
use App\Http\Models\User;
use Arrilot\Widgets\AbstractWidget;

class LastRatings extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @param PlaceRating $placeRating
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(PlaceRating $placeRating, Place $place, User $user)
    {
        $ratings = $placeRating->join($place->getTable(), 'places.id', '=', 'place_id')
                                ->join($user->getTable(), 'users.id', '=', 'user_id')
                                ->orderBy('place_ratings.id', 'desc')
                                ->get(['places.name', 'users.first_name', 'users.last_name', 'place_ratings.*']);

        return view('widgets.last_ratings', [
            'config'    => $this->config,
            'ratings'   => $ratings
        ]);
    }
}
