<?php

namespace App\Http\Controllers;

use App\Http\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Main page
     *
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Place $place)
    {
        $this->_assign('places', $place::where('status_id', 1)->limit(10)->get());

        return view('home.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('home');
    }
}
