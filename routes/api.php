<?php

Route::group(['prefix' => 'v1'], function() {
    Route::group(['namespace' => 'Auth'], function() {
        Route::post('/register', 'RegisterController@register');
    });

    Route::group(['middleware' => 'auth:api'], function() {
        
    });
});