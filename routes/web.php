<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth.registed'], function () {
    /**
     * Home
     */
    Route::get('/','HomeController@index')->name('main');
    Route::get('/home', function() { return redirect(\route('dashboard')); })->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    /**
     * Places
     */
    Route::resource('places', 'PlaceController')->names([
        'index' => 'places.list',
        'show'  => 'places.show'
    ]);

    Route::group(['prefix' => '/places/comments', 'as' => 'places.comments.' ], function () {
        Route::post('/{place}', 'CommentController@store')->name('store');
    });

    /**
     * Guides
     */
    Route::resource('guides', 'GuideController');

    /**
     * Users
     */
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::get('settings', 'UserController@settings')->name('settings');
            Route::post('settings', 'UserController@settingsUpdate')->name('settings.post');

            Route::get('settings/avatar', 'UserController@settingsAvatar')->name('settings.avatar');
            Route::post('settings/avatar', 'UserController@settingsAvatarUpdate')->name('settings.avatar.post');
        });

        Route::get('/', function () { return redirect(
                (Auth::user() ? \route('user.profile', ['user' => Auth::id()]) : \route('login'))
        );})->name('user');

        Route::get('/{user}', 'UserController@user')->name('profile');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
        Route::get('/', 'Admin\HomeController@index')->name('dashboard');

        Route::resource('places', 'Admin\PlaceController', [
            'names' => [
                'index'     => 'places.list',
                'create'    => 'places.create',
                'store'     => 'places.store',
                'show'      => 'places.item',
                'edit'      => 'places.edit',
                'update'    => 'places.update',
                'destroy'   => 'places.delete',
            ]
        ]);

        Route::resource('comments', 'Admin\CommentController', [
            'names' => [
                'index'     => 'comments.list',
                'create'    => 'comments.create',
                'store'     => 'comments.store',
                'show'      => 'comments.item',
                'edit'      => 'comments.edit',
                'update'    => 'comments.update',
                'destroy'   => 'comments.delete',
            ]
        ]);

        Route::group(['prefix' => 'places', 'as' => 'places.images.'], function() {
            Route::get('/{place}/images', 'Admin\PlaceController@attachImages')->name('attach');
            Route::post('/{place}/images', 'Admin\PlaceController@storeImages')->name('store');
        });

        Route::resource('users', 'Admin\UserController', [
            'names' => [
                'index'     => 'users.list',
                'create'    => 'users.create',
                'store'     => 'users.store',
                'show'      => 'users.item',
                'edit'      => 'users.edit',
                'update'    => 'users.update',
                'delete'    => 'users.delete',
            ]
        ]);
    });

    /**
     * Auth
     */
    Auth::routes();
});
