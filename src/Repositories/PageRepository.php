<?php

namespace Grafite\Cms\Repositories;

use Carbon\Carbon;
use Cms;
use Grafite\Cms\Models\Page;
use Grafite\Cms\Repositories\CmsRepository;
use Grafite\Cms\Services\FileService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class PageRepository extends CmsRepository
{
    public $model;

    public $table;

    public function __construct(Page $model)
    {
        $this->model = $model;

        $this->table = 'pages';
    }

    /**
     * Stores Pages into database.
     *
     * @param array $input
     *
     * @return Pages
     */
    public function store($payload)
    {
        $blockCollection = [];

        foreach ($payload as $key => $value) {
            if (stristr($key, 'block_')) {
                $blockName = str_replace('block_', '', $key);
                $blockCollection[$blockName] = $value;
                unset($payload[$key]);
            }
        }

        if (empty($blockCollection)) {
            $payload['blocks'] = "{}";
        } else {
            $payload['blocks'] = json_encode($blockCollection);
        }

        $payload['title'] = htmlentities($payload['title']);
        $payload['url'] = Cms::convertToURL($payload['url']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = FileService::saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        return $this->model->create($payload);
    }

    /**
     * Find Pages by given URL.
     *
     * @param string $url
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findPagesByURL($url)
    {
        $page = null;

        $page = $this->model->where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->first();

        if ($page && app()->getLocale() !== config('cms.default-language')) {
            $page = $this->translationRepo->findByEntityId($page->id, 'Grafite\Cms\Models\Page');
        }

        if (!$page) {
            $page = $this->translationRepo->findByUrl($url, 'Grafite\Cms\Models\Page');
        }

        if ($url === 'home' && app()->getLocale() !== config('cms.default-language')) {
            $page = $this->translationRepo->findByUrl($url, 'Grafite\Cms\Models\Page');
        }

        return $page;
    }

    /**
     * Updates Pages into database.
     *
     * @param Pages $page
     * @param array $input
     *
     * @return Pages
     */
    public function update($page, $payload)
    {
        $blockCollection = [];

        foreach ($payload as $key => $value) {
            if (stristr($key, 'block_')) {
                $blockName = str_replace('block_', '', $key);
                $blockCollection[$blockName] = $value;
                unset($payload[$key]);
            }
        }

        $blockCollection = $this->parseTemplate($payload, $blockCollection);

        $payload['blocks'] = json_encode($blockCollection);

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = FileService::saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        $payload['title'] = htmlentities($payload['title']);

        if (!empty($payload['lang']) && $payload['lang'] !== config('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($page->id, 'Grafite\Cms\Models\Page', $payload['lang'], $payload);
        } else {
            $payload['url'] = Cms::convertToURL($payload['url']);
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $page->update($payload);
        }
    }

    /**
     * Parse the template for blocks.
     *
     * @param  array $payload
     * @param  array $currentBlocks
     *
     * @return array
     */
    public function parseTemplate($payload, $currentBlocks)
    {
        if (isset($payload['template'])) {
            $content = file_get_contents(base_path('resources/themes/'.config('cms.frontend-theme').'/pages/'.$payload['template'].'.blade.php'));

            preg_match_all('/->block\((.*)\)/', $content, $pageMethodMatches);
            preg_match_all('/\@block\((.*)\)/', $content, $bladeMatches);

            $matches = array_unique(array_merge($pageMethodMatches[1], $bladeMatches[1]));

            foreach ($matches as $match) {
                $match = str_replace('"', "", $match);
                $match = str_replace("'", "", $match);
                if (!isset($currentBlocks[$match])) {
                    $currentBlocks[$match] = '';
                }
            }
        }

        return $currentBlocks;
    }
}
