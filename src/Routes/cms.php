<?php

    /*
    |--------------------------------------------------------------------------
    | Cms Routes
    |--------------------------------------------------------------------------
    */

    Route::group([
        'middleware' => [
            'cms-language',
            'cms-analytics'
        ]
    ], function () {
        Route::get('', 'Client\PagesController@home');
        Route::get('pages', 'Client\PagesController@all');
        Route::get('page/{url}', 'Client\PagesController@show');
        Route::get('p/{url}', 'Client\PagesController@show');

        Route::get('gallery', 'Client\GalleryController@all');
        Route::get('gallery/{tag}', 'Client\GalleryController@show');

        Route::get('blog', 'Client\BlogController@all');
        Route::get('blog/{url}', 'Client\BlogController@show');
        Route::get('blog/tags/{tag}', 'Client\BlogController@tag');

        Route::get('faqs', 'Client\FaqController@all');

        Route::get('events', 'Client\EventsController@calendar');
        Route::get('events/{month}', 'Client\EventsController@calendar');
        Route::get('events/all', 'Client\EventsController@all');
        Route::get('events/date/{date}', 'Client\EventsController@date');
        Route::get('events/event/{id}', 'Client\EventsController@show');
    });
