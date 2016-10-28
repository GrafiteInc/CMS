<?php

namespace Yab\Quarx\Controllers;

use URL;
use Quarx;
use Illuminate\Http\Request;
use Yab\Quarx\Models\Widget;
use Yab\Quarx\Requests\WidgetsRequest;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\WidgetRepository;

class WidgetsController extends QuarxController
{
    /** @var WidgetRepository */
    private $widgetsRepository;

    public function __construct(WidgetRepository $widgetsRepo)
    {
        $this->widgetsRepository = $widgetsRepo;
    }

    /**
     * Display a listing of the Widgets.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->widgetsRepository->paginated();

        return view('quarx::modules.widgets.index')
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

        $result = $this->widgetsRepository->search($input);

        return view('quarx::modules.widgets.index')
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
        return view('quarx::modules.widgets.create');
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
            $widgets = $this->widgetsRepository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Quarx::notification('Widgets saved successfully.', 'success');

        return redirect(route('quarx.widgets.edit', [$widgets->id]));
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
        $widgets = $this->widgetsRepository->findWidgetsById($id);

        if (empty($widgets)) {
            Quarx::notification('Widgets not found', 'warning');

            return redirect(route('quarx.widgets.index'));
        }

        return view('quarx::modules.widgets.edit')->with('widgets', $widgets);
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
        $widgets = $this->widgetsRepository->findWidgetsById($id);

        if (empty($widgets)) {
            Quarx::notification('Widgets not found', 'warning');

            return redirect(route('quarx.widgets.index'));
        }

        $widgets = $this->widgetsRepository->update($widgets, $request->all());

        Quarx::notification('Widgets updated successfully.', 'success');

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
        $widgets = $this->widgetsRepository->findWidgetsById($id);

        if (empty($widgets)) {
            Quarx::notification('Widgets not found', 'warning');

            return redirect(route('quarx.widgets.index'));
        }

        $widgets->delete();

        Quarx::notification('Widgets deleted successfully.', 'success');

        return redirect(route('quarx.widgets.index'));
    }
}
