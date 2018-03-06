<?php

namespace Yab\Cabin\Controllers;

use URL;
use Cabin;
use Yab\Cabin\Models\Event;
use Illuminate\Http\Request;
use Yab\Cabin\Requests\EventRequest;
use Yab\Cabin\Services\ValidationService;
use Yab\Cabin\Repositories\EventRepository;

class EventController extends CabinController
{
    public function __construct(EventRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Event.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cabin::modules.events.index')
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

        $result = $this->repository->search($input);

        return view('cabin::modules.events.index')
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
        return view('cabin::modules.events.create');
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
            $event = $this->repository->store($request->all());
            Cabin::notification('Event saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$event) {
            Cabin::notification('Event could not be saved.', 'warning');
        }

        return redirect(route($this->routeBase.'.events.edit', [$event->id]));
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
        $event = $this->repository->findEventById($id);

        if (empty($event)) {
            Cabin::notification('Event not found', 'warning');

            return redirect(route($this->routeBase.'.events.index'));
        }

        return view('cabin::modules.events.edit')->with('event', $event);
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
        $event = $this->repository->findEventById($id);

        if (empty($event)) {
            Cabin::notification('Event not found', 'warning');

            return redirect(route($this->routeBase.'.events.index'));
        }

        $event = $this->repository->update($event, $request->all());
        Cabin::notification('Event updated successfully.', 'success');

        if (!$event) {
            Cabin::notification('Event could not be saved.', 'warning');
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
        $event = $this->repository->findEventById($id);

        if (empty($event)) {
            Cabin::notification('Event not found', 'warning');

            return redirect(route($this->routeBase.'.events.index'));
        }

        $event->delete();

        Cabin::notification('Event deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.events.index'));
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
        $event = $this->repository->findEventById($id);

        return view('cabin::modules.events.history')
            ->with('event', $event);
    }
}
