<?php

namespace App\Http\Controllers;

use App\Http\Models\Suggest;
use App\Http\Models\User;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestController extends Controller
{

    /**
     * Create Method
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $suggest = Auth::user()->placeSuggest()->get();

        $this->_assign('suggest', $suggest->toArray());
        return view('place.suggest');
    }

    /**
     * Store method
     *
     * @param PlaceRequest $request
     * @param Suggest $suggest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PlaceRequest $request, Suggest $suggest)
    {
        $request->request->add(['status_id' => 0, 'place_id' => 0, 'user_id' => Auth::id()]);

        $suggest->fill($request->all());
        $suggest->save();

        return redirect()->back();
    }
}
