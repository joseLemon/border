<?php

Route::get('cms/index', ['as' => 'cms.index', 'uses' => 'CmsController@index']);
Route::post('cms/update', ['as' => 'cms.update', 'uses' => 'CmsController@update']);
Route::post('cms/{id}/delete', ['as' => 'cms.deleteDirectory', 'uses' => 'CmsController@deleteDirectory']);