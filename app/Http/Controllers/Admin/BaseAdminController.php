<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{

    /**
     * BaseAdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_assign('admin_area', true);
    }

}
