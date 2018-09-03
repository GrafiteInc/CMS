<?php

/*
 * --------------------------------------------------------------------------
 * Grafite CMS Config
 * --------------------------------------------------------------------------
*/

return [

    /*
     * --------------------------------------------------------------------------
     * Analytics
     * --------------------------------------------------------------------------
    */

    'analytics' => 'internal',   // google, internal

    /*
     * --------------------------------------------------------------------------
     * Pixabay
     * --------------------------------------------------------------------------
    */

    'pixabay' => env('PIXABAY'),

    /*
     * --------------------------------------------------------------------------
     * Database prefix
     * --------------------------------------------------------------------------
    */

    'db-prefix' => '',

    /*
     * --------------------------------------------------------------------------
     * Live preview in editor
     * --------------------------------------------------------------------------
    */

    'live-preview' => false,

    /*
     * --------------------------------------------------------------------------
     * Front-end
     * --------------------------------------------------------------------------
    */

    'frontend-namespace' => '\App\Http\Controllers\Cms',
    'frontend-theme' => 'default',

    /*
     * --------------------------------------------------------------------------
     * Modules
     * --------------------------------------------------------------------------
    */

    'load-modules' => true,
    'module-directory' => 'cms/modules',
    'active-core-modules' => [
        'blog',
        'menus',
        'files',
        'images',
        'pages',
        'widgets',
        'promotions',
        'events',
        'faqs',
    ],

    /*
     * --------------------------------------------------------------------------
     * RSS
     * --------------------------------------------------------------------------
    */

    'rss' => [
        'title' => '',
        'link' => '',
        'description' => '',
        'name' => '',
    ],

    /*
     * --------------------------------------------------------------------------
     * Site Mapped Modules
     * --------------------------------------------------------------------------
    */

    'site-mapped-modules' => [
        'blog' => 'Grafite\Cms\Repositories\BlogRepository',
        'page' => 'Grafite\Cms\Repositories\PageRepository',
        'events' => 'Grafite\Cms\Repositories\EventRepository',
    ],

    /*
     * --------------------------------------------------------------------------
     * Languages
     * --------------------------------------------------------------------------
    */

    'auto-translate' => false,

    'default-language' => 'en',

    'languages' => [
        'en' => 'english',
        'fr' => 'french',
    ],

    /*
     * --------------------------------------------------------------------------
     * Images and File Storage
     * --------------------------------------------------------------------------
    */

    'storage-location' => 'local', // s3, local
    'max-file-upload-size' => 6291456, // 6MB
    'preview-image-size' => 800, // width - auto height
    'cloudfront' => null, // do not include http

    /*
     * --------------------------------------------------------------------------
     * Admin management
     * --------------------------------------------------------------------------
    */

    'backend-title' => 'Grafite CMS',
    'backend-route-prefix' => 'cms',
    'backend-theme' => 'standard', // dark, standard
    'registration-available' => false,
    'pagination' => 24,

    /*
     * --------------------------------------------------------------------------
     * API key and token
     * --------------------------------------------------------------------------
    */

    'api-key' => env('CMS_API_KEY', 'apis-are-cool'),
    'api-token' => env('CMS_API_TOKEN', 'cms-token'),

    /*
     * --------------------------------------------------------------------------
     * Core Module Forms
     * --------------------------------------------------------------------------
    */

    'forms' => [
        'blog' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
                'tags' => [
                    'type' => 'string',
                    'class' => 'tags',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],

        'images' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
                'custom' => 'checked',
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
        ],

        'images-edit' => [
            'location' => [
                'type' => 'file',
                'alt_name' => 'File',
            ],
            'name' => [
                'type' => 'string',
            ],
            'alt_tag' => [
                'type' => 'string',
                'alt_name' => 'Alt Tag',
            ],
            'title_tag' => [
                'type' => 'string',
                'alt_name' => 'Title Tag',
            ],
            'tags' => [
                'type' => 'string',
                'class' => 'tags',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
        ],

        'page' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],

        'widget' => [
            'name' => [
                'type' => 'string',
            ],
            'slug' => [
                'type' => 'string',
            ],
            'content' => [
                'type' => 'text',
                'class' => 'redactor',
            ],
        ],

        'faqs' => [
            'question' => [
                'type' => 'string',
            ],
            'answer' => [
                'type' => 'text',
                'class' => 'redactor',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
            'published_at' => [
                'type' => 'string',
                'class' => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'custom' => 'autocomplete="off"',
                'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],

        'menu' => [
            'name' => [
                'type' => 'string',
            ],
            'slug' => [
                'type' => 'string',
            ],
        ],

        'link' => [
            'name' => [
                'type' => 'string',
            ],
            'external' => [
                'type' => 'checkbox',
                'custom' => 'value="1"',
            ],
            'external_url' => [
                'type' => 'string',
                'alt_name' => 'Url',
            ],
        ],

        'files' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'file-edit' => [
            'name' => [],
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'event' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'start_date' => [
                    'type' => 'string',
                    'class' => 'datepicker',
                    'custom' => 'autocomplete="off"',
                ],
                'end_date' => [
                    'type' => 'string',
                    'class' => 'datepicker',
                    'custom' => 'autocomplete="off"',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Details',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],
        'promotion' => [
            'identity' => [
                'slug' => [
                    'type' => 'string',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'custom' => 'autocomplete="off"',
                    'alt_name' => 'Publish Date',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
                'finished_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'custom' => 'autocomplete="off"',
                    'alt_name' => 'Finish Date',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Details',
                ],
            ],
        ],
    ],
];
