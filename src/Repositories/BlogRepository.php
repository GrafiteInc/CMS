<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Quarx;
use Yab\Quarx\Models\Blog;

class BlogRepository
{
    /**
     * Returns all Blogs.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Blog::orderBy('created_at', 'desc')->all();
    }

    public function paginated()
    {
        return Blog::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function publishedAndPaginated()
    {
        return Blog::orderBy('created_at', 'desc')->where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->paginate(Config::get('quarx.pagination', 25));
    }

    public function published()
    {
        return Blog::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function tags($tag)
    {
        return Blog::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function allTags()
    {
        $tags = [];
        $blogs = Blog::orderBy('created_at', 'desc')->get();

        foreach ($blogs as $blog) {
            foreach (explode(',', $blog->tags) as $tag) {
                array_push($tags, $tag);
            }
        }

        return array_unique($tags);
    }

    public function search($input)
    {
        $query = Blog::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('blogs');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores Blog into database.
     *
     * @param array $input
     *
     * @return Blog
     */
    public function store($input)
    {
        $input['url'] = Quarx::convertToURL($input['url']);
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

        return Blog::create($input);
    }

    /**
     * Find Blog by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Blog
     */
    public function findBlogById($id)
    {
        return Blog::find($id);
    }

    /**
     * Find Blog by given URL.
     *
     * @param string $url
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findBlogsByURL($url)
    {
        return Blog::where('url', $url)->where('is_published', 1)->first();
    }

    /**
     * Find Blogs by given Tag.
     *
     * @param string $tag
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findBlogsByTag($tag)
    {
        return Blog::where('tags', 'LIKE', "%$tag%")->where('is_published', 1)->get();
    }

    /**
     * Updates Blog into database.
     *
     * @param Blog  $blog
     * @param array $input
     *
     * @return Blog
     */
    public function update($blog, $input)
    {
        $input['url'] = Quarx::convertToURL($input['url']);
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');
        $blog->fill($input);
        $blog->save();

        return $blog;
    }
}
