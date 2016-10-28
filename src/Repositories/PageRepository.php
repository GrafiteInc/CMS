<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Quarx;
use Yab\Quarx\Models\Page;
use Yab\Quarx\Repositories\TranslationRepository;

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
        return Page::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function published()
    {
        return Page::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function search($input)
    {
        $query = Page::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('pages');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores Pages into database.
     *
     * @param array $input
     *
     * @return Pages
     */
    public function store($input)
    {
        $input['url'] = Quarx::convertToURL($input['url']);
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at']) && !empty($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

        return Page::create($input);
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

        $page = Page::where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->first();

        if (! $page) {
            $page = $this->translationRepo->findByUrl($url, 'Yab\Quarx\Models\Page');
        }

        if ($url === 'home' && config('app.locale') !== config('quarx.default-language')) {
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
        if (! empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($page->id, 'Yab\Quarx\Models\Page', $payload);
        } else {
            $payload['url'] = Quarx::convertToURL($payload['url']);
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? $payload['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

            unset($payload['lang']);

            return $page->update($payload);
        }
    }
}
