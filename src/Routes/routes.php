<?php

    Route::group(['middleware' => 'web'], function() {

        /*
        |--------------------------------------------------------------------------
        | Public Routes
        |--------------------------------------------------------------------------
        */

        Route::get('public-preview/{encFileName}', "AssetController@asPreview");
        Route::get('public-asset/{encFileName}', "AssetController@asPublic");
        Route::get('public-download/{encFileName}/{encRealFileName}', "AssetController@asDownload");

        /*
        |--------------------------------------------------------------------------
        | APIs
        |--------------------------------------------------------------------------
        */

        Route::group(['prefix' => 'quarx/api'], function() {
            Route::get('images/list', 'ImagesController@apiList');
            Route::post('images/store', 'ImagesController@apiStore');
        });

        /*
        |--------------------------------------------------------------------------
        | Quarx
        |--------------------------------------------------------------------------
        */

        Route::group(['prefix' => 'quarx', 'middleware' => ['auth', 'quarx']], function(){

            Route::get('asset/{path}/{contentType}', "AssetController@asset");

            Route::get('dashboard', 'DashboardController@main');
            Route::get('help', 'HelpController@main');

            /*
            |--------------------------------------------------------------------------
            | Menus
            |--------------------------------------------------------------------------
            */

            Route::resource('menus', 'MenuController');
            Route::post('menus/search', 'MenuController@search');

            Route::get('menus/{id}/delete', [
                'as' => 'quarx.menus.delete',
                'uses' => 'MenuController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Links
            |--------------------------------------------------------------------------
            */

            Route::resource('links', 'LinksController', ['except' => ['index', 'show']]);

            Route::post('links/search', 'LinksController@search');

            Route::get('links/{id}/delete', [
                'as' => 'quarx.links.delete',
                'uses' => 'LinksController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            Route::resource('images', 'ImagesController');

            Route::get('images/{id}/delete', [
                'as' => 'quarx.images.delete',
                'uses' => 'ImagesController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Blog
            |--------------------------------------------------------------------------
            */

            Route::resource('blog', 'BlogController');
            Route::post('blog/search', 'BlogController@search');

            Route::get('blog/{id}/delete', [
                'as' => 'quarx.blog.delete',
                'uses' => 'BlogController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Pages
            |--------------------------------------------------------------------------
            */

            Route::resource('pages', 'PagesController');
            Route::post('pages/search', 'PagesController@search');

            Route::get('pages/{id}/delete', [
                'as' => 'quarx.pages.delete',
                'uses' => 'PagesController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Widgets
            |--------------------------------------------------------------------------
            */

            Route::resource('widgets', 'WidgetsController');
            Route::post('widgets/search', 'WidgetsController@search');

            Route::get('widgets/{id}/delete', [
                'as' => 'quarx.widgets.delete',
                'uses' => 'WidgetsController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | FAQs
            |--------------------------------------------------------------------------
            */

            Route::resource('faqs', 'FAQController');
            Route::post('faqs/search', 'FAQController@search');

            Route::get('faqs/{id}/delete', [
                'as' => 'quarx.faqs.delete',
                'uses' => 'FAQController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Events
            |--------------------------------------------------------------------------
            */

            Route::resource('events', 'EventController');
            Route::post('events/search', 'EventController@search');

            Route::get('events/{id}/delete', [
                'as' => 'quarx.events.delete',
                'uses' => 'EventController@destroy',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Files
            |--------------------------------------------------------------------------
            */

            Route::get('api/files/list', 'FilesController@apiList');

            Route::get('files/{id}/delete', [
                'as' => 'quarx.files.delete',
                'uses' => 'FilesController@destroy',
            ]);

            Route::get('files/remove/{id}', 'FilesController@remove');
            Route::post('files/upload', 'FilesController@upload');
            Route::post('files/search', 'FilesController@search');

            Route::resource('files', 'FilesController');

        });

    });


