<?php

namespace Yab\Cabin\Controllers;

use Exception;
use Illuminate\Http\Request;
use Cabin;
use Yab\Cabin\Models\Menu;
use Yab\Cabin\Repositories\LinkRepository;
use Yab\Cabin\Repositories\MenuRepository;
use Yab\Cabin\Requests\MenuRequest;
use Yab\Cabin\Services\CabinResponseService;
use Yab\Cabin\Services\ValidationService;

class MenuController extends CabinController
{
    protected $linkRepository;

    public function __construct(MenuRepository $repository, LinkRepository $linkRepository)
    {
        parent::construct();

        $this->repository = $repository;
        $this->linkRepository = $linkRepository;
    }

    /**
     * Display a listing of the Menu.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cabin::modules.menus.index')
            ->with('menus', $result)
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

        return view('cabin::modules.menus.index')
            ->with('menus', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */
    public function create()
    {
        return view('cabin::modules.menus.create');
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param MenuRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validation = ValidationService::check(Menu::$rules);

            if (!$validation['errors']) {
                $menu = $this->repository->store($request->all());
                Cabin::notification('Menu saved successfully.', 'success');

                if (!$menu) {
                    Cabin::notification('Menu could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Cabin::notification($e->getMessage() ?: 'Menu could not be saved.', 'danger');
        }

        return redirect(route($this->routeBase.'.menus.edit', [$menu->id]));
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $menu = $this->repository->findMenuById($id);

        if (empty($menu)) {
            Cabin::notification('Menu not found', 'warning');

            return redirect(route($this->routeBase.'.menus.index'));
        }

        $links = $this->linkRepository->getLinksByMenu($menu->id);

        return view('cabin::modules.menus.edit')->with('menu', $menu)->with('links', $links);
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int         $id
     * @param MenuRequest $request
     *
     * @return Response
     */
    public function update($id, MenuRequest $request)
    {
        try {
            $menu = $this->repository->findMenuById($id);

            if (empty($menu)) {
                Cabin::notification('Menu not found', 'warning');

                return redirect(route($this->routeBase.'.menus.index'));
            }

            $menu = $this->repository->update($menu, $request->all());
            Cabin::notification('Menu updated successfully.', 'success');

            if (!$menu) {
                Cabin::notification('Menu could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Cabin::notification($e->getMessage() ?: 'Menu could not be updated.', 'danger');
        }

        return redirect(route($this->routeBase.'.menus.edit', [$id]));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menu = $this->repository->findMenuById($id);

        if (empty($menu)) {
            Cabin::notification('Menu not found', 'warning');

            return redirect(route($this->routeBase.'.menus.index'));
        }

        $menu->delete();

        Cabin::notification('Menu deleted successfully.');

        return redirect(route($this->routeBase.'.menus.index'));
    }


    /*
    |--------------------------------------------------------------------------
    | Api
    |--------------------------------------------------------------------------
    */

    /**
     * Set the order
     *
     * @return Response
     */
    public function setOrder($id, Request $request)
    {
        $menu = $this->repository->findMenuById($id);
        $result =  $this->repository->setOrder($menu, $request->except('_token'));

        return CabinResponseService::apiResponse('success', $result);
    }
}
