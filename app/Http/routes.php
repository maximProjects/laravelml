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

// if prefix empty

Route::group(['prefix' => '{lang}'], function () {


    Route::get('/', ['uses' => 'FrontController@index']);

    // Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    // Admin routing
    Route::group(['middleware' => 'auth'], function () {
        Route::get('admin/', ['uses' => 'AdminController@index']);

        Route::any('admin/edit/{id}', ['uses' => 'AdminController@edit']);

        Route::any('admin/save/{id}', ['uses' => 'AdminController@save']);

        Route::any('admin/delete/{id}', ['uses' => 'AdminController@delete']);
    });
});
    Route::any('admin/image/{filename}', function ($filename) {
        $path = storage_path() . DIRECTORY_SEPARATOR . 'app.' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $filename;
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file);
        $response->header("Content-Type", $type);
        return $response;
    });


