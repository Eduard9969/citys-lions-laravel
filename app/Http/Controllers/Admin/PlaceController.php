<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Place;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        $places = $place::where('status_id', $status_id)->paginate($this->list_item_count);

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
        $file   = $request->file('main-poster');
        $image  = !empty($file) ? time() . '.' . $file->getClientOriginalExtension() : null;

        if (!empty($image))
            $file->move($this->getImagePath(), $image);

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
     * Get Image Path
     *
     * @return string
     */
    private function getImagePath()
    {
        $path = public_path('images');
        if (!is_dir($path))
            mkdir($path, 0777);

        return $path;
    }

}
