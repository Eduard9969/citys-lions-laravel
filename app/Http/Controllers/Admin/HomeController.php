<?php


namespace App\Http\Controllers\Admin;

use App\Http\Models\Suggest;
use App\Widgets\SuggestPlace;

/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class HomeController extends BaseAdminController
{

    /**
     * Dashboard Get
     *
     * @param Suggest $suggest
     * @return string
     */
    public function index(Suggest $suggest)
    {
        $suggest = Suggest::where([$suggest->getTable() . '.status_id' => 0])
            ->orderBy($suggest->getTable()  . '.id', 'desc')
            ->join('users', 'user_id', '=', 'users.id')
            ->limit(10)
            ->get([$suggest->getTable() . '.*', 'users.first_name', 'users.last_name']);

        $this->_assign('suggest', $suggest->toArray());

        return view('admin.home.index');
    }

}
