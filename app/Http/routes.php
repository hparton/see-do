<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route home page to events.index
Route::get('/', 'EventsController@index');

// Category routes
// Provide controller methods with object instead of ID
Route::model('categories', 'Category');
// Use slugs rather than IDs in URLs
Route::bind('categories', function ($value, $route) {
    return App\Category::whereSlug($value)->first();
});
Route::resource('categories', 'CategoriesController');

// Event routes
Route::model('events', 'Event');
Route::bind('events', function ($value, $route) {
    return App\Event::whereSlug($value)->first();
});
Route::get('events/{value}.json', 'EventsController@showJson');
Route::resource('events', 'EventsController');

// Color Scheme routes
Route::model('color-schemes', 'App\ColorScheme');
Route::resource('color-schemes', 'ColorSchemesController');

// Subscriber routes
Route::model('subscribers', 'App\Subscriber');
Route::get('subscribers/hello', function () {
    return view('subscribers.hello');
});
Route::resource('subscribers', 'SubscribersController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
