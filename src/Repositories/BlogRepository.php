<?php

namespace Grafite\Cms\Repositories;

use Carbon\Carbon;
use Cms;
use Grafite\Cms\Models\Blog;
use Grafite\Cms\Repositories\CmsRepository;
use Grafite\Cms\Repositories\TranslationRepository;
use Grafite\Cms\Services\FileService;

class BlogRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Blog $model, TranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = config('cms.db-prefix').'blogs';
    }

    /**
     * Returns all paginated EventS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function published()
    {
        return $this->model->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->orderBy('created_at', 'desc')
            ->paginate(config('cms.pagination', 24));
    }

    /**
     * Blog tags, with similar name
     *
     * @param  string $tag
     *
     * @return Illuminate\Support\Collection
     */
    public function tags($tag)
    {
        return $this->model->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))
            ->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('created_at', 'desc')
            ->paginate(config('cms.pagination', 24));
    }

    /**
     * Gets all tags of an entry
     *
     * @return Illuminate\Support\Collection
     */
    public function allTags()
    {
        $tags = [];

        if (app()->getLocale() !== config('cms.default-language', 'en')) {
            $blogs = $this->translationRepo->getEntitiesByTypeAndLang(app()->getLocale(), 'Grafite\Cms\Models\Blog');
        } else {
            $blogs = $this->model->orderBy('published_at', 'desc')->get();
        }

        foreach ($blogs as $blog) {
            foreach (explode(',', $blog->tags) as $tag) {
                if ($tag !== '') {
                    array_push($tags, $tag);
                }
            }
        }

        return collect(array_unique($tags));
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
        $payload = $this->parseBlocks($payload, 'blog');

        $payload['title'] = htmlentities($payload['title']);
        $payload['url'] = Cms::convertToURL($payload['url']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = app(FileService::class)->saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        return $this->model->create($payload);
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

        $blog = $this->model->where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->first();

        if (!$blog) {
            $blog = $this->translationRepo->findByUrl($url, 'Grafite\Cms\Models\Blog');
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
        return $this->model->where('tags', 'LIKE', "%$tag%")->where('is_published', 1)->get();
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
        $payload = $this->parseBlocks($payload, 'blog');

        $payload['title'] = htmlentities($payload['title']);

        if (isset($payload['hero_image'])) {
            app(FileService::class)->delete($blog->hero_image);
            $file = request()->file('hero_image');
            $path = app(FileService::class)->saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        if (!empty($payload['lang']) && $payload['lang'] !== config('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($blog->id, 'Grafite\Cms\Models\Blog', $payload['lang'], $payload);
        } else {
            $payload['url'] = Cms::convertToURL($payload['url']);
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $blog->update($payload);
        }
    }
}
