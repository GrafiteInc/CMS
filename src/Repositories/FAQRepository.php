<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Yab\Quarx\Models\FAQ;
use Yab\Quarx\Repositories\TranslationRepository;

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
        return FAQ::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    /**
     * Returns all published Faqs.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function published()
    {
        return FAQ::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
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

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores FAQ into database.
     *
     * @param array $input
     *
     * @return FAQ
     */
    public function store($input)
    {
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at']) && !empty($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

        return FAQ::create($input);
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
        if (! empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($FAQ->id, 'Yab\Quarx\Models\FAQ', $payload);
        } else {
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? $payload['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

            unset($payload['lang']);

            return $FAQ->update($payload);
        }
    }
}
