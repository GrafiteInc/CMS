<?php

namespace Yab\Cabin\Controllers;

use URL;
use Cabin;
use Response;
use Yab\Cabin\Models\Page;
use Illuminate\Http\Request;
use Yab\Cabin\Requests\PagesRequest;
use Yab\Cabin\Services\ValidationService;
use Yab\Cabin\Repositories\PageRepository;

class PagesController extends CabinController
{
    public function __construct(PageRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Pages.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cabin::modules.pages.index')
            ->with('pages', $result)
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

        return view('cabin::modules.pages.index')
            ->with('pages', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Pages.
     *
     * @return Response
     */
    public function create()
    {
        return view('cabin::modules.pages.create');
    }

    /**
     * Store a newly created Pages in storage.
     *
     * @param PagesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Page::$rules);

        if (!$validation['errors']) {
            $pages = $this->repository->store($request->all());
            Cabin::notification('Page saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$pages) {
            Cabin::notification('Page could not be saved.', 'warning');
        }

        return redirect(route($this->routeBase.'.pages.edit', [$pages->id]));
    }

    /**
     * Show the form for editing the specified Pages.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $page = $this->repository->findPagesById($id);

        if (empty($page)) {
            Cabin::notification('Page not found', 'warning');

            return redirect(route($this->routeBase.'.pages.index'));
        }

        return view('cabin::modules.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified Pages in storage.
     *
     * @param int          $id
     * @param PagesRequest $request
     *
     * @return Response
     */
    public function update($id, PagesRequest $request)
    {
        $pages = $this->repository->findPagesById($id);

        if (empty($pages)) {
            Cabin::notification('Page not found', 'warning');

            return redirect(route($this->routeBase.'.pages.index'));
        }

        $pages = $this->repository->update($pages, $request->all());
        Cabin::notification('Page updated successfully.', 'success');

        if (!$pages) {
            Cabin::notification('Page could not be saved.', 'warning');
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Pages from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pages = $this->repository->findPagesById($id);

        if (empty($pages)) {
            Cabin::notification('Page not found', 'warning');

            return redirect(route($this->routeBase.'.pages.index'));
        }

        $pages->delete();

        Cabin::notification('Page deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.pages.index'));
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
        $page = $this->repository->findPagesById($id);

        return view('cabin::modules.pages.history')
            ->with('page', $page);
    }
}
