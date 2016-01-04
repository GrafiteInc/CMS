<?php

    /*
    |--------------------------------------------------------------------------
    | Quarx Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['namespace' => 'App\Http\Controllers\Quarx', 'middleware' => ['web', 'guest']], function() {

        Route::get('', 'PagesController@home');
        Route::get('page', 'PagesController@all');
        Route::get('page/{url}', 'PagesController@show');

        Route::get('blog', 'BlogController@all');
        Route::get('blog/{url}', 'BlogController@show');
        Route::get('blog/tags/{tag}', 'BlogController@tag');

        Route::get('faqs', 'FaqController@all');

    });