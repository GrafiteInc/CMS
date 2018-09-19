<?php

    /*
    |--------------------------------------------------------------------------
    | CMS Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['namespace' => 'Cms', 'middleware' => ['cms-language', 'cms-analytics']], function () {
        if (in_array('pages', config('cms.active-core-modules'))) {
            Route::get('', 'PagesController@home');
            Route::get('pages', 'PagesController@all');
            Route::get('page/{url}', 'PagesController@show');
            Route::get('p/{url}', 'PagesController@show');
        }

        if (in_array('images', config('cms.active-core-modules'))) {
            Route::get('gallery', 'GalleryController@all');
            Route::get('gallery/{tag}', 'GalleryController@show');
        }

        if (in_array('blog', config('cms.active-core-modules'))) {
            Route::get('blog', 'BlogController@all');
            Route::get('blog/{url}', 'BlogController@show');
            Route::get('blog/tags/{tag}', 'BlogController@tag');
        }

        if (in_array('faqs', config('cms.active-core-modules'))) {
            Route::get('faqs', 'FaqController@all');
        }

        if (in_array('events', config('cms.active-core-modules'))) {
            Route::get('events', 'EventsController@calendar');
            Route::get('events/{month}', 'EventsController@calendar');
            Route::get('events/all', 'EventsController@all');
            Route::get('events/date/{date}', 'EventsController@date');
            Route::get('events/event/{id}', 'EventsController@show');
        }
    });
