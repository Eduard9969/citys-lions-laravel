<?php

namespace App\Http\Controllers;

use App\Http\Models\PlaceRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { /* */ }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { /* */ }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PlaceRating $placeRating
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, PlaceRating $placeRating)
    {
        $place_id = $request->get('place_id');
        $rating   = $request->get('rating');

        $placeRating->fill([
            'place_id'  => $place_id,
            'user_id'   => Auth::id(),
            'rating'    => (int) ($rating == 'up')
        ]);
        $placeRating->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) { /* */ }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) { /* */ }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PlaceRating $placeRating
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PlaceRating $placeRating, $id) {
        $rating         = $placeRating::find($id);
        $rating_array   = $rating->toArray();

        if (empty($rating_array) || $rating_array['user_id'] != Auth::id())
            return redirect()->back();

        $value  = $request->get('rating', 'down');
        if ($rating_array['rating'] == ((int) ($value == 'up')))
            return $this->destroy($rating_array['id']);

        $rating->rating = (int) ($value == 'up');
        $rating->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $placeRating = new PlaceRating();
        $placeRating::destroy($id);

        return redirect()->back();
    }

}
