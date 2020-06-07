<?php

namespace App\Http\Controllers;

use App\Http\Models\Guide;

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

    public function edit(Guide $guide)
    {
        $this->_assign('guide', $guide);
        return view('guide.create');
    }
}
