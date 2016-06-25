<?php

    Route::group(['middleware' => 'web'], function () {

        /*
        |--------------------------------------------------------------------------
        | Public Routes
        |--------------------------------------------------------------------------
        */

        Route::get('public-preview/{encFileName}', 'AssetController@asPreview');
        Route::get('public-asset/{encFileName}', 'AssetController@asPublic');
        Route::get('public-download/{encFileName}/{encRealFileName}', 'AssetController@asDownload');

        /*
        |--------------------------------------------------------------------------
        | APIs
        |--------------------------------------------------------------------------
        */

        Route::group(['prefix' => 'quarx/api'], function () {
            Route::get('images/list', 'ImagesController@apiList');
            Route::post('images/store', 'ImagesController@apiStore');
        });

        /*
        |--------------------------------------------------------------------------
        | Quarx
        |--------------------------------------------------------------------------
        */

        Route::group(['prefix' => 'quarx'], function () {
            Route::get('asset/{path}/{contentType}', 'AssetController@asset');

            Route::group(['middleware' => ['auth', 'quarx']], function () {
                Route::get('dashboard', 'DashboardController@main');
                Route::get('help', 'HelpController@main');

                /*
                |--------------------------------------------------------------------------
                | Common Features
                |--------------------------------------------------------------------------
                */

                    Route::get('preview/{entity}/{entityId}', 'QuarxFeatureController@preview');
                Route::get('rollback/{entity}/{entityId}', 'QuarxFeatureController@rollback');

                /*
                |--------------------------------------------------------------------------
                | Menus
                |--------------------------------------------------------------------------
                */

                    Route::resource('menus', 'MenuController');
                Route::post('menus/search', 'MenuController@search');

                /*
                |--------------------------------------------------------------------------
                | Links
                |--------------------------------------------------------------------------
                */

                    Route::resource('links', 'LinksController', ['except' => ['index', 'show']]);
                Route::post('links/search', 'LinksController@search');

                /*
                |--------------------------------------------------------------------------
                | Images
                |--------------------------------------------------------------------------
                */

                    Route::resource('images', 'ImagesController');
                Route::post('images/upload', 'ImagesController@upload');

                /*
                |--------------------------------------------------------------------------
                | Blog
                |--------------------------------------------------------------------------
                */

                    Route::resource('blog', 'BlogController');
                Route::post('blog/search', 'BlogController@search');
                Route::patch('blog/publish/{id}', 'BlogController@publish');

                /*
                |--------------------------------------------------------------------------
                | Pages
                |--------------------------------------------------------------------------
                */

                    Route::resource('pages', 'PagesController');
                Route::post('pages/search', 'PagesController@search');

                /*
                |--------------------------------------------------------------------------
                | Widgets
                |--------------------------------------------------------------------------
                */

                    Route::resource('widgets', 'WidgetsController');
                Route::post('widgets/search', 'WidgetsController@search');

                /*
                |--------------------------------------------------------------------------
                | FAQs
                |--------------------------------------------------------------------------
                */

                    Route::resource('faqs', 'FAQController');
                Route::post('faqs/search', 'FAQController@search');

                /*
                |--------------------------------------------------------------------------
                | Events
                |--------------------------------------------------------------------------
                */

                    Route::resource('events', 'EventController');
                Route::post('events/search', 'EventController@search');

                /*
                |--------------------------------------------------------------------------
                | Files
                |--------------------------------------------------------------------------
                */

                    Route::get('api/files/list', 'FilesController@apiList');

                Route::get('files/remove/{id}', 'FilesController@remove');
                Route::post('files/upload', 'FilesController@upload');
                Route::post('files/search', 'FilesController@search');

                Route::resource('files', 'FilesController');
            });
        });
    });
