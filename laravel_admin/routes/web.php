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
    return view('front.welcome');
});
Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => 'navigation', 'namespace' => 'Admin'], function () {
    Route::get('/dashboard', 'DashboardController@getIndex')->name('home');

    /****** Users *********/
    Route::resource('users', 'UserController');
    Route::post('users/browse',['uses' => 'UserController@browse',  'as' => 'admin.users.browse']);

    /****** Roles *********/
    Route::resource('roles', 'RoleController');
    Route::post('roles/browse',['uses' => 'RoleController@browse',  'as' => 'admin.roles.browse']);

    /****** Roles *********/
    Route::resource('companies', 'CompanyController');
    Route::post('companies/browse',['uses' => 'CompanyController@browse',  'as' => 'admin.companies.browse']);
});