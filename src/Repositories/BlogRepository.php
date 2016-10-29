<?php

namespace Yab\Quarx\Repositories;

use Quarx;
use Carbon\Carbon;
use Yab\Quarx\Models\Blog;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Yab\Quarx\Repositories\TranslationRepository;

class BlogRepository
{
    protected $translationRepo;

    public function __construct()
    {
        $this->translationRepo = app(TranslationRepository::class);
    }

    /**
     * Returns all Blogs.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Blog::orderBy('published_at', 'desc')->all();
    }

    public function paginated()
    {
        return Blog::orderBy('published_at', 'desc')
            ->paginate(Config::get('quarx.pagination', 25));
    }

    public function publishedAndPaginated()
    {
        return Blog::orderBy('published_at', 'desc')->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))
            ->paginate(Config::get('quarx.pagination', 25));
    }

    public function published()
    {
        return Blog::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')
            ->paginate(Config::get('quarx.pagination', 25));
    }

    public function tags($tag)
    {
        return Blog::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))
            ->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('created_at', 'desc')
            ->paginate(Config::get('quarx.pagination', 25));
    }

    public function allTags()
    {
        $tags  = [];
        if (config('app.locale') !== config('quarx.default-language', 'en')) {
            $blogs = $this->translationRepo->getEntitiesByTypeAndLang(config('app.locale'), 'Yab\Quarx\Models\Blog');
        } else {
            $blogs = Blog::orderBy('published_at', 'desc')->get();
        }

        foreach ($blogs as $blog) {
            foreach (explode(',', $blog->tags) as $tag) {
                array_push($tags, $tag);
            }
        }

        return array_unique($tags);
    }

    public function search($input)
    {
        $query = Blog::orderBy('published_at', 'desc');
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
        $input['published_at'] = (isset($input['published_at']) && !empty($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

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
        $blog = null;

        $blog = Blog::where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->first();

        if (! $blog) {
            $blog = $this->translationRepo->findByUrl($url, 'Yab\Quarx\Models\Blog');
        }

        return $blog;
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
    public function update($blog, $payload)
    {
        if (! empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($blog->id, 'Yab\Quarx\Models\Blog', $payload);
        } else {
            $payload['url'] = Quarx::convertToURL($payload['url']);
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? $payload['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

            unset($payload['lang']);

            return $blog->update($payload);
        }
    }
}
