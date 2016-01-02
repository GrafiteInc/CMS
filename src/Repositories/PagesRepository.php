<?php

namespace Mlantz\Quarx\Repositories;

use Mlantz\Quarx\Models\Pages;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Mlantz\Quarx\Services\QuarxService;

class PagesRepository
{

    /**
     * Returns all Pages
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Pages::all();
    }

    public function paginated()
    {
        return Pages::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function published()
    {
        return Pages::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function search($input)
    {
        $query = Pages::orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('pages');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        };

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];

    }

    /**
     * Stores Pages into database
     *
     * @param array $input
     *
     * @return Pages
     */
    public function store($input)
    {
        $input['url'] = QuarxService::convertToURL($input['url']);
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        return Pages::create($input);
    }

    /**
     * Find Pages by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findPagesById($id)
    {
        return Pages::find($id);
    }

    /**
     * Find Pages by given URL
     *
     * @param string $url
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findPagesByURL($url)
    {
        return Pages::where('url', $url)->where('is_published', 1)->first();
    }

    /**
     * Updates Pages into database
     *
     * @param Pages $pages
     * @param array $input
     *
     * @return Pages
     */
    public function update($pages, $input)
    {
        $input['url'] = QuarxService::convertToURL($input['url']);
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;

        $pages->fill($input);
        $pages->save();

        return $pages;
    }
}