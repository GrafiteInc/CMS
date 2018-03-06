<?php

    $routePrefix = config('cabin.backend-route-prefix', 'cabin');

    Route::group(['middleware' => 'web'], function () use ($routePrefix) {

        /*
        |--------------------------------------------------------------------------
        | APIs
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => $routePrefix.'/api'], function () use ($routePrefix) {
            Route::group(['middleware' => ['cabin-api']], function () use ($routePrefix) {
                Route::get('blog', 'ApiController@all');
                Route::get('blog/{id}', 'ApiController@find');

                Route::get('events', 'ApiController@all');
                Route::get('events/{id}', 'ApiController@find');

                Route::get('faqs', 'ApiController@all');
                Route::get('faqs/{id}', 'ApiController@find');

                Route::get('files', 'ApiController@all');
                Route::get('files/{id}', 'ApiController@find');

                Route::get('images', 'ApiController@all');
                Route::get('images/{id}', 'ApiController@find');

                Route::get('pages', 'ApiController@all');
                Route::get('pages/{id}', 'ApiController@find');

                Route::get('widgets', 'ApiController@all');
                Route::get('widgets/{id}', 'ApiController@find');
            });
        });
    });
