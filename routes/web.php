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

/**
 * Home
 */
Route::get('/','HomeController@index');
Route::get('/home', function() { return redirect('/'); })->name('home');

/**
 * Places
 */
Route::resource('places', 'PlacesController');

/**
 * Guides
 */
Route::resource('guides', 'GuidesController');

/**
 * Users
 */
Route::resource('users', 'UsersController');

/**
 * Auth
 */
Auth::routes();
