<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Place;
use App\Http\Models\PlacePicture;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use function GuzzleHttp\Psr7\uri_for;

class PlaceController extends BaseAdminController
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Place $place)
    {
        $status_id = $request->get('status_id', 1);
        $sort_id   = $request->get('sort', 'id');

        $places_statuses = config('statuses.places');
        $statuses = [];

        foreach ($places_statuses as $key => $places_status)
            $statuses[$places_status] = $key;

        $places = $place::where('status_id', $status_id)->orderBy('created_at', 'desc')->paginate($this->list_item_count);

        $this->_assign('places_statuses', $statuses);
        $this->_assign('places', $places);

        return view('admin.places.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->_assign('places_statuses', config('statuses.places'));

        return view('admin.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlaceRequest $request
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(PlaceRequest $request, Place $place)
    {
        $place->fill($request->all());
        $place->saveOrFail();

        return Redirect::to(route('admin.places.list'));
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
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Place $place)
    {
        $this->_assign('places_statuses', config('statuses.places'));
        $this->_assign('place', $place);

        return view('admin.places.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PlaceRequest $request
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlaceRequest $request, Place $place)
    {
        $place->fill($request->all());
        $place->save();

        return redirect()->to(route('admin.places.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Place $place)
    {
        $place->status_id = 0;
        $place->save();

        return redirect()->back();
    }

    /**
     * Attach Images
     *
     * @param Place $place
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attachImages(Place $place)
    {
        $posters     = $place->posters()->get();
        $main_poster = [];
        foreach ($posters->toArray() as $key => $poster)
        {
            if($poster['is_main'])
            {
                $main_poster = $poster;
                unset($posters[$key]);
            }

        }

        $this->_assign('place',       $place);

        $this->_assign('main_poster', $main_poster);
        $this->_assign('posters',     $posters->toArray());

        return view('admin.places.images');
    }

    /**
     * Store Images Place
     *
     * @param Request $request
     * @param Place $place
     * @param PlacePicture $placePicture
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeImages(Request $request, Place $place, PlacePicture $placePicture)
    {
        $poster = $request['poster'] ?? [];

        $main   = isset($poster['main']) && isset($poster['main'][0]) ? $poster['main'][0] : [];
        $other  = $poster['other'] ?? [];

        $path   = $this->getImagePath('places' . '/' . $place->id);

        $fill   = [
            'place_id'  => $place->id,
            'alias'     => '',
            'is_main'   => 0
        ];

        if(!empty($main))
        {
            $main_fill            = $fill;

            $main_fill['alias']   = rand(1, 999999) . '.' . $main->getClientOriginalExtension();
            $main_fill['is_main'] = 1;

            $placePicture->clearMainPoster($place->id);
            $placePicture->fill($main_fill);
            $placePicture->save();

            $main->move($path, $main_fill['alias']);
        }

        $other_fill = [];
        foreach ($other as $item)
        {
            $tmp_fill = $fill;

            $tmp_fill['alias']       = rand(1, 999999) . '.' . $item->getClientOriginalExtension();
            $tmp_fill['created_at']  = $tmp_fill['updated_at'] = Carbon::now('utc')->toDateTimeString();

            $other_fill[] = $tmp_fill;

            $item->move($path, $tmp_fill['alias']);
        }

        if (!empty($other_fill))
            $placePicture::insert($other_fill);

        return redirect()->back();
    }

    /**
     * Remove Pictures
     *
     * @param PlacePicture $place_picture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImages(PlacePicture $place_picture)
    {
        $place_picture::destroy($place_picture->id);
        return redirect()->back();
    }
}
