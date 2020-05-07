<?php

namespace App\Http\Controllers;

use App\Http\Models\Place;
use App\Http\Models\PlaceComment;
use App\Http\Models\User;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(CommentRequest $request, Place $place, PlaceComment $placeComments)
    {
        $placeComments->fill([
            'place_id'  => $place->id,
            'user_id'   => Auth::id(),
            'comment'   => $request->get('comment')
        ]);
        $placeComments->save();

        return redirect()->back();
    }
}
