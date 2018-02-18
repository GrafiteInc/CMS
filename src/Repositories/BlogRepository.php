<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Quarx;
use Yab\Quarx\Models\Blog;
use Yab\Quarx\Services\FileService;

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

    /**
     * Returns all paginated EventS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        $model = app(Blog::class);

        if (isset(request()->dir) && isset(request()->field)) {
            $model = $model->orderBy(request()->field, request()->dir);
        } else {
            $model = $model->orderBy('published_at', 'desc');
        }

        return $model->paginate(config('quarx.pagination', 25));
    }

    /**
     * Returns all paginated EventS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function publishedAndPaginated()
    {
        return Blog::orderBy('published_at', 'desc')->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))
            ->paginate(Config::get('quarx.pagination', 24));
    }

    public function published()
    {
        return Blog::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->orderBy('created_at', 'desc')
            ->paginate(Config::get('quarx.pagination', 24));
    }

    public function tags($tag)
    {
        return Blog::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))
            ->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('created_at', 'desc')
            ->paginate(Config::get('quarx.pagination', 24));
    }

    public function allTags()
    {
        $tags = [];
        if (app()->getLocale() !== config('quarx.default-language', 'en')) {
            $blogs = $this->translationRepo->getEntitiesByTypeAndLang(app()->getLocale(), 'Yab\Quarx\Models\Blog');
        } else {
            $blogs = Blog::orderBy('published_at', 'desc')->get();
        }

        foreach ($blogs as $blog) {
            foreach (explode(',', $blog->tags) as $tag) {
                if ($tag !== '') {
                    array_push($tags, $tag);
                }
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

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 24))->render()];
    }

    /**
     * Stores Blog into database.
     *
     * @param array $input
     *
     * @return Blog
     */
    public function store($payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        $payload['url'] = Quarx::convertToURL($payload['url']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = FileService::saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        return Blog::create($payload);
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

        $blog = Blog::where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->first();

        if (!$blog) {
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
        $payload['title'] = htmlentities($payload['title']);

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = FileService::saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        if (!empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($blog->id, 'Yab\Quarx\Models\Blog', $payload['lang'], $payload);
        } else {
            $payload['url'] = Quarx::convertToURL($payload['url']);
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $blog->update($payload);
        }
    }
}
