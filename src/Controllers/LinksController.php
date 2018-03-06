<?php

namespace Yab\Cabin\Controllers;

use Cabin;
use Exception;
use Yab\Cabin\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yab\Cabin\Requests\LinksRequest;
use Yab\Cabin\Services\ValidationService;
use Yab\Cabin\Repositories\LinkRepository;

class LinksController extends CabinController
{
    public function __construct(LinkRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Links.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cabin::modules.links.index')
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

        return view('cabin::modules.links.create')->with('menu_id', $menu);
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
                $links = $this->repository->store($request->all());
                Cabin::notification('Link saved successfully.', 'success');

                if (!$links) {
                    Cabin::notification('Link could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Cabin::notification($e->getMessage() ?: 'Link could not be saved.', 'danger');
        }

        return redirect(route($this->routeBase.'.menus.edit', [$request->get('menu_id')]));
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
        $links = $this->repository->findLinksById($id);

        if (empty($links)) {
            Cabin::notification('Link not found', 'warning');

            return redirect(route($this->routeBase.'.links.index'));
        }

        return view('cabin::modules.links.edit')->with('links', $links);
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
            $links = $this->repository->findLinksById($id);

            if (empty($links)) {
                Cabin::notification('Link not found', 'warning');

                return redirect(route($this->routeBase.'.links.index'));
            }

            $links = $this->repository->update($links, $request->all());
            Cabin::notification('Link updated successfully.', 'success');

            if (!$links) {
                Cabin::notification('Link could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Cabin::notification($e->getMessage() ?: 'Links could not be updated.', 'danger');
        }

        return redirect(route($this->routeBase.'.links.edit', [$id]));
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
        $links = $this->repository->findLinksById($id);
        $menu = $links->menu_id;

        if (empty($links)) {
            Cabin::notification('Link not found', 'warning');

            return redirect(route($this->routeBase.'.links.index'));
        }

        $links->delete();

        Cabin::notification('Link deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.menus.edit', [$menu]));
    }
}
