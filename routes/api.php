<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::post('token', 'TokensController@store');

    Route::middleware('auth:api')->group(function () {
        Route::resource('links', 'LinksController');
    });
});
