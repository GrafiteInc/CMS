<?php

namespace Mlantz\Quarx\Services;

use Illuminate\Support\Facades\Auth;
use Mlantz\Quarx\Repositories\PagesRepository;

class PageService
{

    public function __construct()
    {
        $this->pageRepo = new PagesRepository;
    }

    public function getPagesAsOptions()
    {
        $pages = [];
        $publishedPages = $this->pageRepo->all();

        foreach ($publishedPages as $page) {
            $pages[$page->title] = $page->id;
        }

        return $pages;
    }

    public function pageName($id)
    {
        $page = $this->pageRepo->findPagesById($id);
        return $page->title;
    }

}