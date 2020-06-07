<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Guide;
use App\Http\Models\User;
use App\Http\Requests\GuideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param Guide $guide
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Guide $guide)
    {
        $guides         = $guide->with('user')->paginate($this->list_item_count);
        $guide_statuses = config('statuses.guides');

        $statuses = [];
        foreach ($guide_statuses as $key => $guide_status)
            $statuses[$guide_status] = $key;

        $this->_assign('guides',            $guides);
        $this->_assign('guide_statuses',    $statuses);

        return view('admin.guides.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(User $user)
    {
        $users          = $user::select(['id', 'login'])->get();
        $guide_statuses = config('statuses.guides');

        $this->_assign('users',             $users->toArray());
        $this->_assign('guide_statuses',    $guide_statuses);

        return view('admin.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Guide $guide
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GuideRequest $request, Guide $guide)
    {
        $guide->fill($request->all());
        $guide->save();

        return redirect()->to(route(Auth::user()->isAdmin() ? 'admin.guides.list' : 'guides.list'));
    }

    /**
     * Display the specified resource.
     *
     * @param Guide $guide
     * @return void
     */
    public function show(Guide $guide) { /* */ }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Guide $guide
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Guide $guide, User $user)
    {
        $guide          = $guide->with('user')->find($guide->id);
        $users          = $user::select(['id', 'login'])->get();
        $guide_statuses = config('statuses.guides');

        $this->_assign('guide',             $guide);
        $this->_assign('users',             $users);
        $this->_assign('guide_statuses',    $guide_statuses);

        return view('admin.guides.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuideRequest $request
     * @param Guide $guide
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GuideRequest $request, Guide $guide)
    {
        return $this->store($request, $guide);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Guide $guide
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Guide $guide)
    {
        $guide::destroy($guide->id);

        return redirect()->back();
    }
}
