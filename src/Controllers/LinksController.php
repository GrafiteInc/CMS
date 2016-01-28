<?php

namespace Yab\Quarx\Controllers;

use Quarx;
use CryptoService;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yab\Quarx\Models\Links;
use Illuminate\Support\Facades\URL;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Requests\LinksRequest;
use Yab\Quarx\Repositories\LinksRepository;

class LinksController extends QuarxController
{

    /** @var  LinksRepository */
    private $linksRepository;

    function __construct(LinksRepository $linksRepo)
    {
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
    public function store(Request $request)
    {
        try {
            $validation = ValidationService::check(Links::$rules);

            if ( ! $validation['errors']) {
                $links = $this->linksRepository->store($request->all());
                Quarx::notification('Link saved successfully.', 'success');

                if (! $links) {
                    Quarx::notification('Link could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Link could not be saved.', 'danger');
        }

        return redirect(URL::to('quarx/menus/'.$request->get('menu_id').'/edit'));
    }

    /**
     * Show the form for editing the specified Links.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $id = CryptoService::decrypt($id);
        $links = $this->linksRepository->findLinksById($id);

        if (empty($links)) {
            Quarx::notification('Link not found', 'warning');
            return redirect(route('quarx.links.index'));
        }

        return view('quarx::modules.links.edit')->with('links', $links);
    }

    /**
     * Update the specified Links in storage.
     *
     * @param  int    $id
     * @param LinksRequest $request
     *
     * @return Response
     */
    public function update($id, LinksRequest $request)
    {
        try {
            $id = CryptoService::decrypt($id);
            $links = $this->linksRepository->findLinksById($id);

            if (empty($links)) {
                Quarx::notification('Link not found', 'warning');
                return redirect(route('quarx.links.index'));
            }

            $links = $this->linksRepository->update($links, $request->all());
            Quarx::notification('Link updated successfully.', 'success');

            if (! $links) {
                Quarx::notification('Link could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Links could not be updated.', 'danger');
        }

        return redirect(route('quarx.links.edit', [CryptoService::encrypt($id)]));
    }

    /**
     * Remove the specified Links from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $id = CryptoService::decrypt($id);
        $links = $this->linksRepository->findLinksById($id);
        $menu = CryptoService::encrypt($links->menu_id);


        if (empty($links)) {
            Quarx::notification('Link not found', 'warning');
            return redirect(route('quarx.links.index'));
        }

        $links->delete();

        Quarx::notification('Link deleted successfully.', 'success');

        return redirect(URL::to('quarx/menus/'.$menu.'/edit'));
    }

}
