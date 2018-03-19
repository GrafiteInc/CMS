<?php

namespace graphite\Quarx\Controllers;

use URL;
use Quarx;
use graphite\Quarx\Models\Event;
use Illuminate\Http\Request;
use graphite\Quarx\Requests\EventRequest;
use graphite\Quarx\Services\ValidationService;
use graphite\Quarx\Repositories\EventRepository;

class EventController extends QuarxController
{
    /** @var EventRepository */
    protected $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        parent::construct();

        $this->eventRepository = $eventRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->eventRepository->paginated();

        return view('quarx::modules.events.index')
            ->with('events', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->eventRepository->search($input);

        return view('quarx::modules.events.index')
            ->with('events', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('quarx::modules.events.create');
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param EventRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Event::$rules);

        if (!$validation['errors']) {
            $event = $this->eventRepository->store($request->all());
            Quarx::notification('Event saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$event) {
            Quarx::notification('Event could not be saved.', 'warning');
        }

        return redirect(route($this->quarxRouteBase.'.events.edit', [$event->id]));
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->findEventById($id);

        if (empty($event)) {
            Quarx::notification('Event not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.events.index'));
        }

        return view('quarx::modules.events.edit')->with('event', $event);
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int          $id
     * @param EventRequest $request
     *
     * @return Response
     */
    public function update($id, EventRequest $request)
    {
        $event = $this->eventRepository->findEventById($id);

        if (empty($event)) {
            Quarx::notification('Event not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.events.index'));
        }

        $event = $this->eventRepository->update($event, $request->all());
        Quarx::notification('Event updated successfully.', 'success');

        if (!$event) {
            Quarx::notification('Event could not be saved.', 'warning');
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->findEventById($id);

        if (empty($event)) {
            Quarx::notification('Event not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.events.index'));
        }

        $event->delete();

        Quarx::notification('Event deleted successfully.', 'success');

        return redirect(route($this->quarxRouteBase.'.events.index'));
    }

    /**
     * Page history.
     *
     * @param int $id
     *
     * @return Response
     */
    public function history($id)
    {
        $event = $this->eventRepository->findEventById($id);

        return view('quarx::modules.events.history')
            ->with('event', $event);
    }
}
