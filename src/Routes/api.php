<?php

    $routePrefix = config('cms.backend-route-prefix', 'cms');

    Route::group(['middleware' => 'web'], function () use ($routePrefix) {

        /*
        |--------------------------------------------------------------------------
        | APIs
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => $routePrefix.'/api'], function () use ($routePrefix) {
            Route::group(['middleware' => ['cms-api']], function () use ($routePrefix) {
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
