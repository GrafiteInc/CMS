<?php

namespace Yab\Quarx\Repositories;

use Illuminate\Support\Facades\Schema;
use Yab\Quarx\Models\Widget;

class WidgetRepository
{
    protected $translationRepo;

    public function __construct()
    {
        $this->translationRepo = app(TranslationRepository::class);
    }

    /**
     * Returns all Widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Widget::orderBy('created_at', 'desc')->all();
    }

    /**
     * Returns all paginated EventS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        $model = app(Widget::class);

        if (isset(request()->dir) && isset(request()->field)) {
            $model = $model->orderBy(request()->field, request()->dir);
        } else {
            $model = $model->orderBy('created_at', 'desc');
        }

        return $model->paginate(config('quarx.pagination', 25));
    }

    public function search($input)
    {
        $query = Widget::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('widgets');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(25)->render()];
    }

    /**
     * Stores Widgets into database.
     *
     * @param array $input
     *
     * @return Widgets
     */
    public function store($input)
    {
        $input['name'] = htmlentities($input['name']);

        return Widget::create($input);
    }

    /**
     * Find Widgets by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Widgets
     */
    public function findWidgetsById($id)
    {
        return Widget::find($id);
    }

    /**
     * Find Widgets by given slug.
     *
     * @param int $slug
     *
     * @return \Illuminate\Support\Collection|null|static|Widgets
     */
    public static function getWidgetBySLUG($slug)
    {
        return Widget::where('slug', $slug)->first();
    }

    /**
     * Updates Widgets into database.
     *
     * @param Widgets $widgets
     * @param array   $input
     *
     * @return Widgets
     */
    public function update($widgets, $payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        if (!empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($widgets->id, 'Yab\Quarx\Models\Widget', $payload['lang'], $payload);
        } else {
            unset($payload['lang']);

            return $widgets->update($payload);
        }
    }
}
