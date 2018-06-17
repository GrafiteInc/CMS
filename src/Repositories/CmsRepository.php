<?php

namespace Grafite\Cms\Repositories;

use Carbon\Carbon;
use Grafite\Cms\Repositories\TranslationRepository;
use Illuminate\Support\Facades\Schema;

class CmsRepository
{
    public $translationRepo;

    public $model;

    public $table;

    public function __construct(TranslationRepository $translationRepo)
    {
        $this->translationRepo = $translationRepo;
    }

    /**
     * Returns all Widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->get()->all();
    }

    /**
     * Returns all paginated items.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        $model = $this->model;

        if (isset(request()->dir) && isset(request()->field)) {
            $model = $model->orderBy(request()->field, request()->dir);
        } else {
            $model = $model->orderBy('created_at', 'desc');
        }

        return $model->paginate(config('cms.pagination', 25));
    }

    /**
     * Returns all published items.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function published()
    {
        return $this->model->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'desc')
            ->paginate(config('cms.pagination', 24));
    }

    /**
     * Returns all public items
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function arePublic()
    {
        if (Schema::hasColumn($this->model->getTable(), 'is_published')) {
            $query = $this->model->where('is_published', 1);

            if (Schema::hasColumn($this->model->getTable(), 'published_at')) {
                $query->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'));
            }

            return $query->orderBy('created_at', 'desc')->get();
        }

        return $this->model->orderBy('created_at', 'desc')->get();
    }

    /**
     * Search the columns of a given table
     *
     * @param  array $payload
     *
     * @return array
     */
    public function search($payload)
    {
        $query = $this->model->orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$payload['term'].'%');

        $columns = Schema::getColumnListing($this->table);

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$payload['term'].'%');
        }

        return [$query, $payload['term'], $query->paginate(25)->render()];
    }

    /**
     * Stores Widgets into database.
     *
     * @param array $payload
     *
     * @return Widgets
     */
    public function store($payload)
    {
        return $this->model->create($payload);
    }

    /**
     * Find Widgets by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Widgets
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find items by slug.
     *
     * @param int $slug
     *
     * @return \Illuminate\Support\Collection|null|static|Model
     */
    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Find items by url.
     *
     * @param int $url
     *
     * @return \Illuminate\Support\Collection|null|static|Model
     */
    public function getByUrl($url)
    {
        return $this->model->where('url', $url)->first();
    }

    /**
     * Updates items into database.
     *
     * @param Model $model
     * @param array $payload
     *
     * @return Model
     */
    public function update($model, $payload)
    {
        return $model->update($payload);
    }

    /**
     * Convert block payloads into json
     *
     * @param  array $payload
     * @param  string $module
     *
     * @return array
     */
    public function parseBlocks($payload, $module)
    {
        $blockCollection = [];

        foreach ($payload as $key => $value) {
            if (stristr($key, 'block_')) {
                $blockName = str_replace('block_', '', $key);
                $blockCollection[$blockName] = $value;
                unset($payload[$key]);
            }
        }

        $blockCollection = $this->parseTemplate($payload, $blockCollection, $module);

        if (empty($blockCollection)) {
            $payload['blocks'] = "{}";
        } else {
            $payload['blocks'] = json_encode($blockCollection);
        }

        return $payload;
    }

    /**
     * Parse the template for blocks.
     *
     * @param  array $payload
     * @param  array $currentBlocks
     *
     * @return array
     */
    public function parseTemplate($payload, $currentBlocks, $module)
    {
        if (isset($payload['template'])) {
            $content = file_get_contents(base_path('resources/themes/'.config('cms.frontend-theme').'/'.$module.'/'.$payload['template'].'.blade.php'));

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
