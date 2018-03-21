<?php

namespace Grafite\Cms\Services;

use Illuminate\Support\Facades\Config;
use Grafite\Cms\Repositories\PageRepository;

class PageService
{
    public function __construct()
    {
        $this->repo = app(PageRepository::class);
    }

    public function getPagesAsOptions()
    {
        $pages = [];
        $publishedPages = $this->repo->all();

        foreach ($publishedPages as $page) {
            $pages[$page->title] = $page->id;
        }

        return $pages;
    }

    public function getTemplatesAsOptions()
    {
        $availableTemplates = ['show'];
        $templates = glob(base_path('resources/themes/'.Config::get('cms.frontend-theme').'/pages/*'));

        foreach ($templates as $template) {
            $template = str_replace(base_path('resources/themes/'.Config::get('cms.frontend-theme').'/pages/'), '', $template);
            if (stristr($template, 'template')) {
                $template = str_replace('-template.blade.php', '', $template);
                if (!stristr($template, '.php')) {
                    $availableTemplates[] = $template.'-template';
                }
            }
        }

        return $availableTemplates;
    }

    public function pageName($id)
    {
        $page = $this->repo->find($id);

        return $page->title;
    }
}
