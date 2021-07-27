<?php

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

Route::get('/', function () {
    return view('login');
});

Route::get('/login', ['as' => 'login','uses' => 'App\Http\Controllers\HomeController@login']);
Route::post('/loginc', ['as' => 'login.user','uses' => 'App\Http\Controllers\HomeController@logincheck']);
Route::get('/logout', ['as' => 'logout','uses' => 'App\Http\Controllers\HomeController@logout']);
Route::get('/register', ['as' => 'register','uses' => 'App\Http\Controllers\HomeController@register']);
Route::post('/uregister', ['as' => 'registerpost','uses' => 'App\Http\Controllers\HomeController@registerpost']);
Route::get('/home', ['as' => 'home','uses' => 'App\Http\Controllers\HomeController@home'])->middleware('auth');
Route::get('/checkout/{id}', ['as' => 'checkout','uses' => 'App\Http\Controllers\HomeController@checkout']);
Route::post('/order', ['as' => 'order','uses' => 'App\Http\Controllers\HomeController@orderstore']);
Route::get('/cart', ['as' => 'cart','uses' => 'App\Http\Controllers\HomeController@cart']);
Route::get('/myorder', ['as' => 'myorder','uses' => 'App\Http\Controllers\HomeController@myorder']);
Route::get('addtocart/{id}', ['as' => 'addtocart','uses' => 'App\Http\Controllers\HomeController@addToCart']);
Route::patch('updatecart', ['as' => 'updatecart','uses' => 'App\Http\Controllers\HomeController@update']);

Route::delete('removecart', ['as' => 'removecart','uses' => 'App\Http\Controllers\HomeController@remove']);