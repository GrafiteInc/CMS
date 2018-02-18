<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Yab\Quarx\Models\Event;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class EventRepository
{
    protected $translationRepo;

    public function __construct()
    {
        $this->translationRepo = app(TranslationRepository::class);
    }

    /**
     * Returns all EventS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Event::orderBy('created_at', 'desc')->get();
    }

    /**
     * Returns all paginated EventS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        $model = app(Event::class);

        if (isset(request()->dir) && isset(request()->field)) {
            $model = $model->orderBy(request()->field, request()->dir);
        } else {
            $model = $model->orderBy('created_at', 'desc');
        }

        return $model->paginate(config('quarx.pagination', 25));
    }

    /**
     * Returns all published Events.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findEventsByDate($date)
    {
        return Event::where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->where('start_date', '<=', $date)->where('end_date', '>=', $date)->get();
    }

    /**
     * Returns all published Events.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function published()
    {
        return Event::where('is_published', 1)->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 24));
    }

    /**
     * Search Event.
     *
     * @param string $input
     *
     * @return Event
     */
    public function search($input)
    {
        $query = Event::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('events');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 24))->render()];
    }

    /**
     * Stores Event into database.
     *
     * @param array $payload
     *
     * @return Event
     */
    public function store($payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        return Event::create($payload);
    }

    /**
     * Find Event by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Event
     */
    public function findEventById($id)
    {
        return Event::find($id);
    }

    /**
     * Updates Event into database.
     *
     * @param Event $event
     * @param array $input
     *
     * @return Event
     */
    public function update($event, $payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        if (!empty($payload['lang']) && $payload['lang'] !== config('quarx.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($event->id, 'Yab\Quarx\Models\Event', $payload['lang'], $payload);
        } else {
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $event->update($payload);
        }
    }
}
