<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelRoles\Models\Role;

class UserController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        $users = $user::orderBy('created_at', 'desc')->paginate($this->list_item_count);

        $users_statuses = config('statuses.users');
        $statuses = [];

        foreach ($users_statuses as $key => $users_status)
            $statuses[$users_status] = $key;

        $this->_assign('users', $users);
        $this->_assign('users_statuses', $statuses);

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users_statuses = config('statuses.users');
        $users_roles    = Role::all(['id', 'slug', 'name'])->toArray();

        $statuses = [];
        foreach ($users_statuses as $key => $status_id)
            $statuses[$status_id] = $key;

        $roles = [];
        foreach ($users_roles as $role)
            $roles[$role['id']] = $role['name'];

        $this->_assign('roles', $roles);
        $this->_assign('users_statuses', $users_statuses);

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        $user->attachRole($request->get('role_id'));

        return redirect()->to(route('admin.users.list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) { /* */ }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $users_statuses = config('statuses.users');
        $users_roles    = Role::all(['id', 'slug', 'name'])->toArray();

        $statuses = [];
        foreach ($users_statuses as $key => $status_id)
            $statuses[$status_id] = $key;

        $roles = [];
        foreach ($users_roles as $role)
            $roles[$role['id']] = $role['name'];

        $this->_assign('user',  $user->toArray() + ['role' => $user->roles()->first()->toArray()]);
        $this->_assign('roles', $roles);
        $this->_assign('users_statuses', $users_statuses);

        return view('admin.users.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request = $request->all();

        if (empty($request['password']))
            unset($request['password']);

        $user->fill($request);
        $user->save();

        $user->syncRoles([$request['role_id']]);

        return redirect()->to(route('admin.users.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if (Auth::id() == $user->id)
            return redirect()->back();

        $user->status_id = 2;
        $user->save();

        return redirect()->back();
    }
}
