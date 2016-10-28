<?php

namespace Yab\Quarx\Controllers;

use URL;
use Quarx;
use Response;
use Yab\Quarx\Models\Page;
use Illuminate\Http\Request;
use Yab\Quarx\Requests\PagesRequest;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\PageRepository;

class PagesController extends QuarxController
{
    /** @var PageRepository */
    private $pagesRepository;

    public function __construct(PageRepository $pagesRepo)
    {
        $this->pagesRepository = $pagesRepo;
    }

    /**
     * Display a listing of the Pages.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->pagesRepository->paginated();

        return view('quarx::modules.pages.index')
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

        $result = $this->pagesRepository->search($input);

        return view('quarx::modules.pages.index')
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
        return view('quarx::modules.pages.create');
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
            $pages = $this->pagesRepository->store($request->all());
            Quarx::notification('Page saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$pages) {
            Quarx::notification('Page could not be saved.', 'warning');
        }

        return redirect(route('quarx.pages.edit', [$pages->id]));
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
        $page = $this->pagesRepository->findPagesById($id);

        if (empty($page)) {
            Quarx::notification('Page not found', 'warning');

            return redirect(route('quarx.pages.index'));
        }

        return view('quarx::modules.pages.edit')->with('page', $page);
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
        $pages = $this->pagesRepository->findPagesById($id);

        if (empty($pages)) {
            Quarx::notification('Page not found', 'warning');

            return redirect(route('quarx.pages.index'));
        }

        $pages = $this->pagesRepository->update($pages, $request->all());
        Quarx::notification('Page updated successfully.', 'success');

        if (!$pages) {
            Quarx::notification('Page could not be saved.', 'warning');
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
        $pages = $this->pagesRepository->findPagesById($id);

        if (empty($pages)) {
            Quarx::notification('Page not found', 'warning');

            return redirect(route('quarx.pages.index'));
        }

        $pages->delete();

        Quarx::notification('Page deleted successfully.', 'success');

        return redirect(route('quarx.pages.index'));
    }
}
