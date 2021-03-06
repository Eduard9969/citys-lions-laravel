<?php

namespace App\Http\Controllers;

use App\Http\Models\Place;
use App\Http\Models\PlaceRating;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Place $place
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Place $place, Request $request)
    {
        $sort   = $request->get('sort_by', 'created_at_desc');
        $filter = $request->get('filter');

        $allow_direct  = ['asc', 'desc'];
        $allow_sort    = ['created_at', 'name'];

        $sort_field = $directive = '';

        if(!empty($sort))
        {
            $arr = explode('_', $sort);

            if(!empty($arr))
            {
                $directive = array_reverse($arr)[0];
                $directive = in_array($directive, $allow_direct) ? $directive : 'desc';

                unset($arr[count($arr) - 1]);

                $sort_field = implode('_', $arr);
                $sort_field = in_array($sort_field, $allow_sort) ? $sort_field : 'created_at';

                $sort       = $sort_field . '_' . $directive;
            }
        }

        $places = $place::where('status_id', 1)->orderBy($sort_field, $directive)->paginate($this->list_item_count);
        foreach ($places as $key => $place)
        {
            $poster = $place->posters()->where('is_main', 1)->get()->toArray();
            $places[$key]->main_poster = (isset($poster[0]) && isset($poster[0]['alias']) ? $poster[0]['alias'] : '');
        }

        $this->_assign('places',        $places);

        $this->_assign('allow_sort',    $allow_sort);
        $this->_assign('sort',          $sort);

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
        if (!$place->status_id)
        {
            if (!Auth::user()->isAdmin())
                return redirect()->to(route('places.list'));

            $this->_assign('archive', true);
        }

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

        $all_rating  = $place->rating()->count(['id']);
        $ok_rating   = $place->rating()->where('rating', 1)->count(['id']);
        $user_rating = $place->rating()->where('user_id', Auth::id())->get()->toArray();

        $rating['value'] = ($all_rating == $ok_rating
                                ? $ok_rating : ($ok_rating > 0
                                    ? ($all_rating - $ok_rating) : ($ok_rating - $all_rating)));

        $this->_assign('place',             $place);
        $this->_assign('place_posters',     $posters);
        $this->_assign('place_main_poster', $main_poster);

        $this->_assign('comments',  $comments);

        $this->_assign('rating',        $rating);
        $this->_assign('user_rating',   isset($user_rating[0]) ? $user_rating[0] : []);

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
