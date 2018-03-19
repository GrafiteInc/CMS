<?php

namespace Grafite\Cms\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class ApiController extends GrafiteCmsController
{
    protected $model;

    public function __construct(Request $request)
    {
        parent::construct();

        $this->modelName = str_singular($request->segment(3));
        if (! empty($this->modelName)) {
            $this->model = app('Grafite\Cms\Models\\'.ucfirst($this->modelName));
        }
    }

    /**
     * Find an item in the API
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Collect all items of a resource
     *
     * @return Collection
     */
    public function all()
    {
        $query = $this->model;

        if (Schema::hasColumn(str_plural($this->modelName), 'published_at')) {
            $query = $query->where('is_published', 1)
                ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'));
        }

        return $query
            ->orderBy('created_at', 'desc')
            ->paginate(Config::get('cms.pagination', 24));
    }

    /**
     * Search for the API Item
     *
     * @param  string $term
     *
     * @return array
     */
    public function search($term)
    {
        $query = $this->model->orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing(str_plural($this->modelName));

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [
            'term' => $input['term'],
            'result' => $query->paginate(Config::get('cms.pagination', 24)),
        ];
    }
}
