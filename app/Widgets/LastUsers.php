<?php

namespace App\Widgets;

use App\Http\Models\User;
use Arrilot\Widgets\AbstractWidget;

class LastUsers extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(User $user)
    {
        $users = $user->where('status_id', 1)
                    ->where('first_name', '!=', null)
                    ->limit(10)
                    ->orderBy('id', 'desc')
                    ->get(['id', 'login', 'first_name', 'last_name', 'avatar_alias'])
                    ->toArray();

        return view('widgets.last_users', [
            'config' => $this->config,
            'users'  => $users
        ]);
    }
}
