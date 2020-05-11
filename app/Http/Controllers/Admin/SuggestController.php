<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Place;
use App\Http\Models\Suggest;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;

class SuggestController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Suggest $suggest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Suggest $suggest)
    {
        $status_id = $request->get('status_id');
        $this->_assign('status_id', $status_id);

        $statuses  = ['Pending', 'Success', 'Rejected'];
        $status_id = is_null($status_id) ? array_keys($statuses) : [$status_id];

        $suggest_list = $suggest::select([$suggest->getTable() . '.*', 'users.first_name', 'users.last_name'])
                            ->whereIN($suggest->getTable() . '.status_id', $status_id)
                            ->join('users', 'user_id', '=', 'users.id')
                            ->orderBy($suggest->getTable() . '.id', 'desc')
                            ->paginate($this->list_item_count);

        $this->_assign('suggest_list',  $suggest_list);
        $this->_assign('statuses',      $statuses);

        return view('admin.suggest.list');
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param Suggest $suggest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Suggest $suggest)
    {
        $author = $suggest->author()->first();

        $this->_assign('suggest',   $suggest);
        $this->_assign('user',      $author);

        return view('admin.suggest.item');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Suggest $suggest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Suggest $suggest)
    {
        $author = $suggest->author()->first();

        $this->_assign('suggest',   $suggest);
        $this->_assign('user',      $author);

        return view('admin.suggest.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PlaceRequest $request
     * @param Suggest $suggest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlaceRequest $request, Suggest $suggest)
    {
        $suggest->fill($request->all());
        $suggest->save();

        return redirect()->to(route('admin.suggest.item', ['suggest' => $suggest->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}

    public function answer(Suggest $suggest, Request $request, Place $place)
    {
        $status_id = $request->get('status_id');
        if ($status_id == 1)
        {
            $suggest_arr = $suggest->toArray();
            $suggest_arr['status_id'] = 1;

            $place->fill($suggest_arr);

            if (!$place->save())
                return redirect()->back()->withErrors([__('An error has occurred')]);

            $suggest->place_id  = $place->id;
        }

        $suggest->status_id = $status_id;
        $suggest->save();

        return redirect()->to(route('admin.suggest.list'));
    }
}
