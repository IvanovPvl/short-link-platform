<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('{short}', 'RedirectController@perform');