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
        $places = $place::where('status_id', 1)->limit(10)->orderBy('created_at', 'desc')->get();
        foreach ($places as $key => $item)
        {
            $poster = $item->posters()->where('is_main', 1)->get()->toArray();
            $places[$key]->main_poster = (isset($poster[0]) && isset($poster[0]['alias']) ? $poster[0]['alias'] : '');
        }

        $this->_assign('places', $places);

        return view('home.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        return redirect()->to(route('user.user'));
//        return view('home');
    }
}
