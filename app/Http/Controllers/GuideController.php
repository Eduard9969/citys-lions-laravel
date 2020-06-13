<?php

namespace App\Http\Controllers;

use App\Http\Models\Guide;
use App\Http\Models\Place;
use App\Http\Requests\GuideRequest;
use App\Http\Requests\PlaceRequest;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Guide $guide
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Guide $guide)
    {
        $guides = $guide->with('user')
                        ->where('status_id', 1)
                        ->paginate($this->list_item_count);

        $user_guide = $guide->where('user_id', $this->user_id)->first();

        $this->_assign('guides',        $guides);
        $this->_assign('user_guide',    $user_guide);

        return view('guide.list');
    }

    /**
     * Create Guide Profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('guide.create');
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

        return redirect()->to(route('guides.list'));
    }

    /**
     * Edit Guide Profile
     *
     * @param Guide $guide
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Guide $guide)
    {
        $this->_assign('guide', $guide);
        return view('guide.create');
    }

    /**
     * Update Guide Profile
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
     * Remove guide profile
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
