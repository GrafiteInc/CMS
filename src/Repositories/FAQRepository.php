<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Yab\Quarx\Models\FAQ;

class FAQRepository
{
    protected $translationRepo;

    public function __construct()
    {
        $this->translationRepo = app(TranslationRepository::class);
    }

    /**
     * Returns all FAQS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return FAQ::orderBy('created_at', 'desc')->get();
    }

    /**
     * Returns all paginated FAQS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        $model = app(FAQ::class);

        if (isset(request()->dir) && isset(request()->field)) {
            $model = $model->orderBy(request()->field, request()->dir);
        } else {
            $model = $model->orderBy('created_at', 'desc');
        }

        return $model->paginate(Config::get('quarx.pagination', 24));
    }

    /**
     * Returns all published Faqs.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function published()
    {
        return FAQ::where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 24));
    }

    /**
     * Search FAQ.
     *
     * @param string $input
     *
     * @return FAQ
     */
    public function search($input)
    {
        $query = FAQ::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('faqs');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 24))->render()];
    }

    /**
     * Stores FAQ into database.
     *
     * @param array $payload
     *
     * @return FAQ
     */
    public function store($payload)
    {
        $payload['question'] = htmlentities($payload['question']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        return FAQ::create($payload);
    }

    /**
     * Find FAQ by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|FAQ
     */
    public function findFaqById($id)
    {
        return FAQ::find($id);
    }

    /**
     * Updates FAQ into database.
     *
     * @param FAQ   $FAQ
     * @param array $input
     *
     * @return FAQ
     */
    public function update($FAQ, $payload)
    {
        $payload['question'] = htmlentities($payload['question']);

        if (!empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($FAQ->id, 'Yab\Quarx\Models\FAQ', $payload['lang'], $payload);
        } else {
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $FAQ->update($payload);
        }
    }
}
