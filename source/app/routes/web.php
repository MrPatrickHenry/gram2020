<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware' => ['auth']], function(){
 
    Route::get('/instagram/callback/', 'InstagramController@Index');

Route::post('user/profile/instagram', 'InstagramController@show');


Route::get('/rates', function () {
    return view('rates');
});


});