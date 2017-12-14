<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Quarx;
use Yab\Quarx\Models\Page;
use Yab\Quarx\Services\FileService;

class PageRepository
{
    protected $translationRepo;

    public function __construct()
    {
        $this->translationRepo = app(TranslationRepository::class);
    }

    /**
     * Returns all Pages.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Page::all();
    }

    public function paginated()
    {
        $model = app(Page::class);

        if (isset(request()->dir) && isset(request()->field)) {
            $model = $model->orderBy(request()->field, request()->dir);
        } else {
            $model = $model->orderBy('created_at', 'desc');
        }

        return $model->paginate(Config::get('quarx.pagination', 24));
    }

    public function published()
    {
        return Page::where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 24));
    }

    public function search($input)
    {
        $query = Page::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('pages');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 24))->render()];
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

        $payload['url'] = Quarx::convertToURL($payload['url']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = FileService::saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        return Page::create($payload);
    }

    /**
     * Find Pages by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findPagesById($id)
    {
        return Page::find($id);
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

        $page = Page::where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->first();

        if ($page && app()->getLocale() !== config('quarx.default-language')) {
            $page = $this->translationRepo->findByEntityId($page->id, 'Yab\Quarx\Models\Page');
        }

        if (!$page) {
            $page = $this->translationRepo->findByUrl($url, 'Yab\Quarx\Models\Page');
        }

        if ($url === 'home' && app()->getLocale() !== config('quarx.default-language')) {
            $page = $this->translationRepo->findByUrl($url, 'Yab\Quarx\Models\Page');
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

        if (!empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($page->id, 'Yab\Quarx\Models\Page', $payload['lang'], $payload);
        } else {
            $payload['url'] = Quarx::convertToURL($payload['url']);
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
            $content = file_get_contents(base_path('resources/themes/'.config('quarx.frontend-theme').'/pages/'.$payload['template'].'.blade.php'));

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
