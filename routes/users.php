<?php

/*
|--------------------------------------------------------------------------
| USERS Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => '\App\Http\Middleware\IsUserAdmin'], function() {
    Route::get('users/show', ['as' => 'users.show', 'uses' => 'UsersController@show']);
    Route::get('users/getUsers', ['as' => 'users.get', 'uses' => 'UsersController@getUsers']);
    Route::get('user/{id}/edit', ['as' => 'user.edit', 'uses' => 'UsersController@edit']);
    Route::post('user/{id}', ['as' => 'user.update', 'uses' => 'UsersController@update']);
    Route::get('user/delete', ['as' => 'user.delete', 'uses' => 'UsersController@delete']);
});