<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Quarx;
use Yab\Quarx\Models\Pages;

class PagesRepository
{
    /**
     * Returns all Pages.
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
        return Pages::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function search($input)
    {
        $query = Pages::orderBy('created_at', 'desc');

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
        $input['published_at'] = (isset($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

        return Pages::create($input);
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
        return Pages::find($id);
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
        return Pages::where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->first();
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
        $input['published_at'] = (isset($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');
        $pages->fill($input);
        $pages->save();

        return $pages;
    }
}
