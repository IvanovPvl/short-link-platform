<?php

Route::get('/', 'HomeController@index');
Route::get('{short}', 'RedirectController@perform');
