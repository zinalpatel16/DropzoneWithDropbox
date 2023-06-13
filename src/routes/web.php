<?php

Route::group(['namespace' => 'Hcipl\DropzoneWithDropbox\Controllers', 'middleware' => ['web']], function(){

	Route::get('image/index', ['as' => 'image/index', 'uses' => 'ImageUploadController@index']);
	Route::get('/image/data', ['as' => 'image/data', 'uses' => 'ImageUploadController@ajaxData']);
	Route::get('image/upload', 'ImageUploadController@fileCreate');
	Route::post('image/upload/store', 'ImageUploadController@fileStore');
	Route::get('/image/delete/{id?}/{filename?}', [ 'as' => 'image/delete', 'uses' => 'ImageUploadController@fileDestroy']);
	Route::delete('image/deleteall', 'ImageUploadController@deleteAll');
    }
);
?>
