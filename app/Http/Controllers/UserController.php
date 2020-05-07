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
        $user['roles'] = $user->roles;
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
        $this->_assign('user', Auth::user()->toArray());

        return view('auth.settings-avatar');
    }

    /**
     * Settings Avatar Post
     * @param Request $request
     * @param User $user
     */
    public function settingsAvatarUpdate(Request $request, User $user)
    {
        $avatar = $request->file('avatar');
        $user = User::find(Auth::id());

        if (empty($user->toArray()) || empty($avatar))
            return redirect()->back();

        $alias = rand(1, 999999) . $avatar->getClientOriginalExtension();

        $user->avatar_alias = $alias;
        $user->save();

        $path = $this->getImagePath('user_pic/' . $user->id);
        $avatar->move($path, $alias);

        return redirect()->to(route('user.user'));
    }
}
