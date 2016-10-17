<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;
use Yab\Quarx\Services\EventService;
use Yab\Quarx\Repositories\EventRepository;

class EventsController extends Controller
{
    private $eventsRepository;

    public function __construct(EventRepository $eventsRepo, EventService $eventService)
    {
        $this->eventsRepository = $eventsRepo;
        $this->eventService = $eventService;
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

        $events = $this->eventService->calendar($date);
        $calendar = $this->eventService->generate($date);

        if (empty($calendar)) {
            abort(404);
        }

        return view('quarx-frontend::events.calendar')
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
        $events = $this->eventsRepository->findEventsByDate($date);

        if (empty($events)) {
            abort(404);
        }

        return view('quarx-frontend::events.date')->with('events', $events);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $events = $this->eventsRepository->published();

        if (empty($events)) {
            abort(404);
        }

        return view('quarx-frontend::events.all')->with('events', $events);
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
        $event = $this->eventsRepository->findEventById($id);

        if (empty($event)) {
            abort(404);
        }

        return view('quarx-frontend::events.'.$event->template)->with('event', $event);
    }
}
