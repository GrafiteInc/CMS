<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Grafite\Cms\Services\EventService;
use Grafite\Cms\Repositories\EventRepository;

class EventsController extends Controller
{
    protected $repository;

    public function __construct(EventRepository $repository, EventService $service)
    {
        $this->repository = $repository;
        $this->service = $service;

        if (!in_array('events', config('cms.active-core-modules'))) {
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

        return view('cms-frontend::events.calendar')
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

        return view('cms-frontend::events.date')->with('events', $events);
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

        return view('cms-frontend::events.all')->with('events', $events);
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
        $event = $this->repository->find($id);

        if (empty($event)) {
            abort(404);
        }

        return view('cms-frontend::events.'.$event->template)->with('event', $event);
    }
}
