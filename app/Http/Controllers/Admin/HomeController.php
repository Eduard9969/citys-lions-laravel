<?php


namespace App\Http\Controllers\Admin;

/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class HomeController extends BaseAdminController
{

    /**
     * Dashboard Get
     *
     * @return string
     */
    public function index()
    {
        return view('admin.home.index');
    }

}
