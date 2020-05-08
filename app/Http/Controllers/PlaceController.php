<?php

namespace App\Http\Controllers;

use App\Http\Models\Place;
use App\Http\Models\User;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Place $place)
    {
        $places = $place::paginate($this->list_item_count);
        foreach ($places as $key => $place)
        {
            $poster = $place->posters()->where('is_main', 1)->get()->toArray();
            $places[$key]->main_poster = (isset($poster[0]) && isset($poster[0]['alias']) ? $poster[0]['alias'] : '');
        }

        $this->_assign('places', $places);

        return view('place.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { /**/ }

    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Place $place)
    {
        $posters     = $place->posters()->get()->toArray();
        $main_poster = [];

        foreach ($posters as $key => $poster)
        {
            if ($poster['is_main'])
            {
                unset($posters[$key]);
                $main_poster = $poster;
            }
        }

        $comments = $place->comments()
                        ->join('users', 'place_comments.user_id', '=', 'users.id')
                        ->get()
                        ->toArray();

        $this->_assign('place',             $place);
        $this->_assign('place_posters',     $posters);
        $this->_assign('place_main_poster', $main_poster);

        $this->_assign('comments', $comments);

        return view('place.item');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) { /**/ }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) { /**/ }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) { /**/ }
}
