<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    /**
     * Auth user_id
     * @var int
     */
    protected $user_id = 0;

    /**
     * Auth login
     * @var string
     */
    protected $user_login = null;

    /**
     * Controller constructor.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user_id    = (int) Auth::id();
            $this->setUserId();

            $this->user_login = isset(Auth::user()->login) ? Auth::user()->login : null;
            $this->setUserLogin();

            return $next($request);
        });
    }

    /**
     * A simple form of assigning a view variable
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    private static function setViewAssign($key, $value)
    {
        return View::share($key, $value);
    }

    /**
     * Assigning a variable to the template body
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function _assign($key, $value)
    {
        return self::setViewAssign($key, $value);
    }

    /**
     * Assign User Id
     *
     * @return mixed
     */
    private function setUserId()
    {
        return $this->_assign('user_id', $this->user_id);
    }

    /**
     * Assign User Login
     *
     * @return mixed
     */
    private function setUserLogin()
    {
        return $this->_assign('user_login', $this->user_login);
    }
}
