<?php

namespace App\Widgets;

use App\Http\Models\PlaceComment;
use Arrilot\Widgets\AbstractWidget;

class LastComments extends AbstractWidget
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
     * @param PlaceComment $placeComment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(PlaceComment $placeComment)
    {
        $comments = $placeComment->select(['place_id', 'comment', 'user_id', 'first_name', 'last_name'])
                        ->join('users', 'user_id', '=', 'users.id')
                        ->limit(10)
                        ->orderBy('place_comments.created_at', 'desc')
                        ->get();

        return view('widgets.last_comments', [
            'config'    => $this->config,
            'comments'  => $comments->toArray()
        ]);
    }
}
