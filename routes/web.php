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

// Route::get('/', 'IndexController@index');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('users', 'UsersController');
    Route::resource('guru', 'GuruController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostsController');
    Route::resource('comments', 'CommentsController', ['except' => ['create', 'store']]);

    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings', 'SettingsController@store')->name('settings.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/api/datatable/users', 'UsersController@dataTable')->name('api.datatable.users');
    Route::get('/api/datatable/guru', 'GuruController@dataTable')->name('api.datatable.guru');
    Route::get('/api/datatable/siswa', 'SiswaController@dataTable')->name('api.datatable.siswa');
    Route::get('/api/datatable/categories', 'CategoriesController@dataTable')->name('api.datatable.categories');
    Route::get('/api/datatable/posts', 'PostsController@dataTable')->name('api.datatable.posts');
    Route::get('/api/datatable/comments', 'CommentsController@dataTable')->name('api.datatable.comments');
});
