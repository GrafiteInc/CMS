<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Yab\Quarx\Models\Event;

class EventRepository
{
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
        return Event::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    /**
     * Returns all published Events.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findEventsByDate($date)
    {
        return Event::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')->where('start_date', '<=', $date)->where('end_date', '>=', $date)->get();
    }

    /**
     * Returns all published Events.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function published()
    {
        return Event::where('is_published', 1)->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'))->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
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

        $columns = Schema::getColumnListing('events');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores Event into database.
     *
     * @param array $input
     *
     * @return Event
     */
    public function store($input)
    {
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');

        return Event::create($input);
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
    public function update($event, $input)
    {
        $input['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = (isset($input['published_at'])) ? $input['published_at'] : Carbon::now()->format('Y-m-d h:i:s');
        $event->fill($input);
        $event->save();

        return $event;
    }
}
