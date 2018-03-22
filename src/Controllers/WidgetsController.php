<?php

namespace Grafite\Cms\Controllers;

use Cms;
use Illuminate\Http\Request;
use Grafite\Cms\Models\Widget;
use Grafite\Cms\Requests\WidgetRequest;
use Grafite\Cms\Services\ValidationService;
use Grafite\Cms\Repositories\WidgetRepository;

class WidgetsController extends GrafiteCmsController
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

        return view('cms::modules.widgets.index')
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

        return view('cms::modules.widgets.index')
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
        return view('cms::modules.widgets.create');
    }

    /**
     * Store a newly created Widgets in storage.
     *
     * @param WidgetRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Widget::$rules);

        if (!$validation['errors']) {
            $widgets = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Cms::notification('Widgets saved successfully.', 'success');

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
        $widget = $this->repository->find($id);

        if (empty($widget)) {
            Cms::notification('Widgets not found', 'warning');

            return redirect(route($this->routeBase.'.widgets.index'));
        }

        return view('cms::modules.widgets.edit')->with('widget', $widget);
    }

    /**
     * Update the specified Widgets in storage.
     *
     * @param int            $id
     * @param WidgetRequest $request
     *
     * @return Response
     */
    public function update($id, WidgetRequest $request)
    {
        $widgets = $this->repository->find($id);

        if (empty($widgets)) {
            Cms::notification('Widgets not found', 'warning');

            return redirect(route($this->routeBase.'.widgets.index'));
        }

        $widgets = $this->repository->update($widgets, $request->all());

        Cms::notification('Widgets updated successfully.', 'success');

        return redirect(url()->previous());
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
        $widgets = $this->repository->find($id);

        if (empty($widgets)) {
            Cms::notification('Widgets not found', 'warning');

            return redirect(route($this->routeBase.'.widgets.index'));
        }

        $widgets->delete();

        Cms::notification('Widgets deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.widgets.index'));
    }
}
