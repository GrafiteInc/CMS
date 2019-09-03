<?php

namespace Grafite\Cms\Forms;

use Grafite\Cms\Models\Blog;
use Grafite\Cms\Forms\Fields\Tags;
use Grafite\FormMaker\Fields\File;
use Grafite\FormMaker\Fields\Text;
use Grafite\FormMaker\Fields\Hidden;
use Grafite\FormMaker\Fields\Select;
use Grafite\Cms\Services\BlogService;
use Grafite\FormMaker\Fields\Checkbox;
use Grafite\FormMaker\Fields\TextArea;
use Grafite\FormMaker\Forms\ModelForm;

class BlogForm extends ModelForm
{
    public $model = Blog::class;

    public $routePrefix = 'cms.blog';

    public $buttons = [
        'submit' => 'Save',
    ];

    public $columns = 'sections';

    public $hasFiles = true;

    public function fields()
    {
        return [
            Text::make('title', [
                'required' => true,
            ]),
            Text::make('url', [
                'required' => true,
                'label' => 'Slug'
            ]),
            Tags::make('tags'),
            Select::make('template', [
                'options' => $this->templateSelect()
            ]),
            TextArea::make('entry', [
                'class' => 'redactor'
            ]),
            File::make('hero_image', [
                'label' => 'Hero Image'
            ]),
            Text::make('seo_description', [
                'label' => 'SEO Description'
            ]),
            Text::make('seo_keywords', [
                'label' => 'SEO Keywords'
            ]),
            Text::make('published_at', [
                'label' => 'Published At',
                'class' => 'datetimepicker form-control'
            ]),
            Checkbox::make('is_published', [
                'label' => 'Is Published',
            ]),
            Hidden::make('lang', [
                'value' => request('lang', config('cms.default-language'))
            ]),

        ];
    }

    public function setSections()
    {
        return [
            [
                'title',
                'url',
                'tags',
            ],
            [
                'template',
            ],
            [
                'entry',
            ],
            [

                'hero_image',
            ],
            [
                'seo_description',
                'seo_keywords',
            ],
            [
                'published_at',
                'is_published',
            ],
            [
                'lang'
            ]
        ];
    }

    public function templateSelect()
    {
        $availableTemplates = [];
        $templates = app(BlogService::class)->getTemplatesAsOptions();

        foreach ($templates as $template) {
            $availableTemplates[ucfirst(str_replace('-template', '', $template))] = $template;
        }

        return $availableTemplates;

        return [];
    }
}
