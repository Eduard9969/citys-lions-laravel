<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * User Get
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user(User $user)
    {
        $this->_assign('user', $user->toArray());

        return view('auth.user');
    }

    /**
     * Setting Get
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings(Request $request)
    {
        $this->_assign('user', User::find(Auth::id())->toArray());
        $this->_assign('without_pass', $request->session()->get('without_password', false));

        return view('auth.settings');
    }

    /**
     * Settings Post
     *
     * @param SettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingsUpdate(SettingRequest $request)
    {
        $without_password = $request->session()->get('without_password', false);

        $user = User::where('id', Auth::id())->firstOrFail();
        $user->fill($request->all());
        $user->save();

        $request->session()->remove('without_password');
        $request->session()->flash('message', __('Success Update'));

        return $without_password ? redirect()->to(route('user.user')) : redirect()->back();
    }

    /**
     * Settings Avatar
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsAvatar(Request $request)
    {
        $this->_assign('user', Auth::user());

        return view('auth.settings-avatar');
    }

    /**
     * Settings Avatar Post
     * @param Request $request
     */
    public function settingsAvatarUpdate(Request $request)
    {

    }
}
