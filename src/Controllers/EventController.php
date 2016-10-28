<?php

namespace Yab\Quarx\Controllers;

use URL;
use Quarx;
use Yab\Quarx\Models\Event;
use Illuminate\Http\Request;
use Yab\Quarx\Requests\EventRequest;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\EventRepository;

class EventController extends QuarxController
{
    /** @var EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
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

        return redirect(route('quarx.events.edit', [$event->id]));
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

            return redirect(route('quarx.events.index'));
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

            return redirect(route('quarx.events.index'));
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

            return redirect(route('quarx.events.index'));
        }

        $event->delete();

        Quarx::notification('Event deleted successfully.', 'success');

        return redirect(route('quarx.events.index'));
    }
}
