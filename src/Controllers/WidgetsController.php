<?php

namespace Yab\Cabin\Controllers;

use URL;
use Cabin;
use Illuminate\Http\Request;
use Yab\Cabin\Models\Widget;
use Yab\Cabin\Requests\WidgetsRequest;
use Yab\Cabin\Services\ValidationService;
use Yab\Cabin\Repositories\WidgetRepository;

class WidgetsController extends CabinController
{
    public function __construct(WidgetRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Widgets.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cabin::modules.widgets.index')
            ->with('widgets', $result)
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

        return view('cabin::modules.widgets.index')
            ->with('widgets', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Widgets.
     *
     * @return Response
     */
    public function create()
    {
        return view('cabin::modules.widgets.create');
    }

    /**
     * Store a newly created Widgets in storage.
     *
     * @param WidgetsRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Widget::$rules);

        if (!$validation['errors']) {
            $widgets = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Cabin::notification('Widgets saved successfully.', 'success');

        return redirect(route($this->routeBase.'.widgets.edit', [$widgets->id]));
    }

    /**
     * Show the form for editing the specified Widgets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $widgets = $this->repository->findWidgetsById($id);

        if (empty($widgets)) {
            Cabin::notification('Widgets not found', 'warning');

            return redirect(route($this->routeBase.'.widgets.index'));
        }

        return view('cabin::modules.widgets.edit')->with('widgets', $widgets);
    }

    /**
     * Update the specified Widgets in storage.
     *
     * @param int            $id
     * @param WidgetsRequest $request
     *
     * @return Response
     */
    public function update($id, WidgetsRequest $request)
    {
        $widgets = $this->repository->findWidgetsById($id);

        if (empty($widgets)) {
            Cabin::notification('Widgets not found', 'warning');

            return redirect(route($this->routeBase.'.widgets.index'));
        }

        $widgets = $this->repository->update($widgets, $request->all());

        Cabin::notification('Widgets updated successfully.', 'success');

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Widgets from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $widgets = $this->repository->findWidgetsById($id);

        if (empty($widgets)) {
            Cabin::notification('Widgets not found', 'warning');

            return redirect(route($this->routeBase.'.widgets.index'));
        }

        $widgets->delete();

        Cabin::notification('Widgets deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.widgets.index'));
    }
}
