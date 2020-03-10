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


//Queste sono le route del PANELLO
Route::group(['prefix' => 'cms'], function ()
{
    /*
     * Per ogni route che non sia login chiamo il middleware "cms.isauth:cms"
     * cms.isauth è l'alias configurato per il middleware Cms\IsAuth nel Kernel.php
     * :cms corrisponde al tipo di guard che usiamo per l'autenitcazione in config/auth.php
     */
    Route::middleware('cms.isauth:cms')->group(function ()
    {
        Route::get('/', 'Cms\Dashboard\DashboardController@index');
    });

    Route::get('/login', 'Cms\Auth\LoginController@showLoginForm')->name('cms.login');
    Route::post('/login','Cms\Auth\LoginController@login');
    Route::get('/register','Cms\Auth\RegisterController@showRegistrationForm')->name('cms.register');
    Route::post('/register','Cms\Auth\RegisterController@register');

});
