<?php

namespace App\Http\Controllers\Cabin;

use App\Http\Controllers\Controller;
use Yab\Cabin\Services\EventService;
use Yab\Cabin\Repositories\EventRepository;

class EventsController extends Controller
{
    protected $repository;

    public function __construct(EventRepository $repository, EventService $service)
    {
        $this->repository = $repository;
        $this->service = $service;

        if (!in_array('events', config('cabin.active-core-modules'))) {
            return redirect('/')->send();
        }
    }

    /**
     * Calendar.
     *
     * @param string $date
     *
     * @return Response
     */
    public function calendar($date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        $events = $this->service->calendar($date);
        $calendar = $this->service->generate($date);

        if (empty($calendar)) {
            abort(404);
        }

        return view('cabin-frontend::events.calendar')
            ->with('events', $events)
            ->with('calendar', $calendar);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function date($date)
    {
        $events = $this->repository->findEventsByDate($date);

        if (empty($events)) {
            abort(404);
        }

        return view('cabin-frontend::events.date')->with('events', $events);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $events = $this->repository->published();

        if (empty($events)) {
            abort(404);
        }

        return view('cabin-frontend::events.all')->with('events', $events);
    }

    /**
     * Display the specified Page.
     *
     * @param string $date
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->repository->findEventById($id);

        if (empty($event)) {
            abort(404);
        }

        return view('cabin-frontend::events.'.$event->template)->with('event', $event);
    }
}
