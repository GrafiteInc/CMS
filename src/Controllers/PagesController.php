<?php

namespace Grafite\Cms\Controllers;

use Cms;
use Grafite\Cms\Models\Page;
use Illuminate\Http\Request;
use Grafite\Cms\Requests\PagesRequest;
use Grafite\Cms\Services\ValidationService;
use Grafite\Cms\Repositories\PageRepository;

class PagesController extends GrafiteCmsController
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

        return view('cms::modules.pages.index')
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

        return view('cms::modules.pages.index')
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
        return view('cms::modules.pages.create');
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
        $validation = app(ValidationService::class)->check(Page::$rules);

        if (!$validation['errors']) {
            $pages = $this->repository->store($request->all());
            Cms::notification('Page saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$pages) {
            Cms::notification('Page could not be saved.', 'warning');
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
        $page = $this->repository->find($id);

        if (empty($page)) {
            Cms::notification('Page not found', 'warning');

            return redirect(route($this->routeBase.'.pages.index'));
        }

        return view('cms::modules.pages.edit')->with('page', $page);
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
        $pages = $this->repository->find($id);

        if (empty($pages)) {
            Cms::notification('Page not found', 'warning');

            return redirect(route($this->routeBase.'.pages.index'));
        }

        $pages = $this->repository->update($pages, $request->all());
        Cms::notification('Page updated successfully.', 'success');

        if (!$pages) {
            Cms::notification('Page could not be saved.', 'warning');
        }

        return redirect(url()->previous());
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
        $pages = $this->repository->find($id);

        if (empty($pages)) {
            Cms::notification('Page not found', 'warning');

            return redirect(route($this->routeBase.'.pages.index'));
        }

        $pages->delete();

        Cms::notification('Page deleted successfully.', 'success');

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
        $page = $this->repository->find($id);

        return view('cms::modules.pages.history')
            ->with('page', $page);
    }
}
