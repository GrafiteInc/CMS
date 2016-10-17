<?php

namespace Yab\Quarx\Repositories;

use Quarx;
use Carbon\Carbon;
use Yab\Quarx\Models\Page;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class PageRepository
{
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
        return Page::where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->first();
    }

    /**
     * Updates Pages into database.
     *
     * @param Pages $pages
     * @param array $input
     *
     * @return Pages
     */
    public function update($pages, $input)
    {
        $input['url'] = Quarx::convertToURL($input['url']);
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at']) && !empty($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

        return $pages->update($input);
    }
}
