<?php

/*
|--------------------------------------------------------------------------
| Quarx Forms
|--------------------------------------------------------------------------
*/

return [

    'blog' => [
        'title'       => [
            'type' => 'string',
        ],
        'url'       => [
            'type' => 'string',
        ],
        'tags'       => [
            'type' => 'string',
            'class' => 'tags'
        ],
        'entry'       => [
            'type' => 'text',
            'class' => 'redactor',
            'alt_name' => 'Content',
        ],
        'is_published' => [
            'type' => 'checkbox',
            'alt_name' => 'Published'
        ],
    ],

    'images' => [
        'location'       => [
            'type' => 'file',
            'alt_name' => 'File'
        ],
        'name'       => [
            'type' => 'string',
        ],
        'alt_tag'       => [
            'type' => 'string',
            'alt_name' => 'Alt Tag',
        ],
        'title_tag'       => [
            'type' => 'string',
            'alt_name' => 'Title Tag',
        ],
        'is_published' => [
            'type' => 'checkbox',
            'alt_name' => 'Published'
        ],
    ],

    'page' => [
        'title'       => [
            'type' => 'string',
        ],
        'url'       => [
            'type' => 'string',
        ],
        'entry'       => [
            'type' => 'text',
            'class' => 'redactor',
            'alt_name' => 'Content',
        ],
        'is_published' => [
            'type' => 'checkbox',
            'alt_name' => 'Published'
        ],
    ],

    'widget' => [
        'name'       => [
            'type' => 'string',
        ],
        'uuid'       => [
            'type' => 'string',
        ],
        'content'       => [
            'type' => 'text',
            'class' => 'redactor',
        ],
    ],

    'faqs' => [
        'question'       => [
            'type' => 'string',
        ],
        'answer'       => [
            'type' => 'text',
            'class' => 'redactor',
        ],
        'is_published' => [
            'type' => 'checkbox',
            'alt_name' => 'Published'
        ],
    ],

    'link' => [
        'name'       => [
            'type' => 'string',
        ],
        'external'       => [
            'type' => 'checkbox',
            'custom' => 'value="1"'
        ],
        'external_url' => [
            'type' => 'string',
            'alt_name' => 'Url'
        ],
        'page_id' => [
            'type' => 'select',
            'alt_name' => 'Page',
            'options' => PageService::getPagesAsOptions()
        ],
        'menu_id' => [
            'type' => 'hidden',
        ],
    ],

    'files' => [
        'published'      => [
            'type' => 'checkbox',
        ],
        'tags'       => [
            'custom' => 'data-role="tagsinput"'
        ],
        'details'       => [
            'type' => 'textarea'
        ],
    ],

    'file-edit' => [
        'name'       => [],
        'published'      => [
            'type' => 'checkbox',
        ],
        'tags'       => [
            'custom' => 'data-role="tagsinput"'
        ],
        'details'       => [
            'type' => 'textarea'
        ],
    ],

];