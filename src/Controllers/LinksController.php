<?php

namespace graphite\Quarx\Controllers;

use Quarx;
use Exception;
use graphite\Quarx\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use graphite\Quarx\Requests\LinksRequest;
use graphite\Quarx\Services\ValidationService;
use graphite\Quarx\Repositories\LinkRepository;

class LinksController extends QuarxController
{
    /** @var LinkRepository */
    private $linksRepository;

    public function __construct(LinkRepository $linksRepo)
    {
        parent::construct();

        $this->linksRepository = $linksRepo;
    }

    /**
     * Display a listing of the Links.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->linksRepository->paginated();

        return view('quarx::modules.links.index')
            ->with('links', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Show the form for creating a new Links.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $menu = $request->get('m');

        return view('quarx::modules.links.create')->with('menu_id', $menu);
    }

    /**
     * Store a newly created Links in storage.
     *
     * @param LinksRequest $request
     *
     * @return Response
     */
    public function store(LinksRequest $request)
    {
        try {
            $validation = ValidationService::check(Link::$rules);

            if (!$validation['errors']) {
                $links = $this->linksRepository->store($request->all());
                Quarx::notification('Link saved successfully.', 'success');

                if (!$links) {
                    Quarx::notification('Link could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Link could not be saved.', 'danger');
        }

        return redirect(route($this->quarxRouteBase.'.menus.edit', [$request->get('menu_id')]));
    }

    /**
     * Show the form for editing the specified Links.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $links = $this->linksRepository->findLinksById($id);

        if (empty($links)) {
            Quarx::notification('Link not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.links.index'));
        }

        return view('quarx::modules.links.edit')->with('links', $links);
    }

    /**
     * Update the specified Links in storage.
     *
     * @param int          $id
     * @param LinksRequest $request
     *
     * @return Response
     */
    public function update($id, LinksRequest $request)
    {
        try {
            $links = $this->linksRepository->findLinksById($id);

            if (empty($links)) {
                Quarx::notification('Link not found', 'warning');

                return redirect(route($this->quarxRouteBase.'.links.index'));
            }

            $links = $this->linksRepository->update($links, $request->all());
            Quarx::notification('Link updated successfully.', 'success');

            if (!$links) {
                Quarx::notification('Link could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Links could not be updated.', 'danger');
        }

        return redirect(route($this->quarxRouteBase.'.links.edit', [$id]));
    }

    /**
     * Remove the specified Links from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $links = $this->linksRepository->findLinksById($id);
        $menu = $links->menu_id;

        if (empty($links)) {
            Quarx::notification('Link not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.links.index'));
        }

        $links->delete();

        Quarx::notification('Link deleted successfully.', 'success');

        return redirect(route($this->quarxRouteBase.'.menus.edit', [$menu]));
    }
}
