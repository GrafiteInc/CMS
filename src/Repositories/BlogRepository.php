<?php

namespace Mlantz\Quarx\Repositories;

use Mlantz\Quarx\Models\Blog;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class BlogRepository
{

    /**
     * Returns all Blogs
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
        return Blog::orderBy('created_at', 'desc')->where('is_published', 1)->paginate(Config::get('quarx.pagination', 25));
    }

    public function published()
    {
        return Blog::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function tags($tag)
    {
        return Blog::where('is_published', 1)->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
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

        $columns = Schema::getColumnListing('blogs');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        };

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores Blog into database
     *
     * @param array $input
     *
     * @return Blog
     */
    public function store($input)
    {
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        return Blog::create($input);
    }

    /**
     * Find Blog by given id
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
     * Find Blog by given URL
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
     * Find Blogs by given Tag
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
     * Updates Blog into database
     *
     * @param Blog $blog
     * @param array $input
     *
     * @return Blog
     */
    public function update($blog, $input)
    {
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $blog->fill($input);
        $blog->save();

        return $blog;
    }
}