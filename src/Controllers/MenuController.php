<?php

namespace Yab\Quarx\Controllers;

use Exception;
use Illuminate\Http\Request;
use Quarx;
use Yab\Quarx\Models\Menu;
use Yab\Quarx\Repositories\LinkRepository;
use Yab\Quarx\Repositories\MenuRepository;
use Yab\Quarx\Requests\MenuRequest;
use Yab\Quarx\Services\QuarxResponseService;
use Yab\Quarx\Services\ValidationService;

class MenuController extends QuarxController
{
    /** @var MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo, LinkRepository $linkRepo)
    {
        $this->menuRepository = $menuRepo;
        $this->linkRepository = $linkRepo;
    }

    /**
     * Display a listing of the Menu.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->menuRepository->paginated();

        return view('quarx::modules.menus.index')
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

        $result = $this->menuRepository->search($input);

        return view('quarx::modules.menus.index')
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
        return view('quarx::modules.menus.create');
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

            if ($validation['errors']) {
                return $validation['redirect'];
            }
            $menu = $this->menuRepository->store($request->all());
            Quarx::notification('Menu saved successfully.', 'success');

            if (!$menu) {
                Quarx::notification('Menu could not be saved.', 'danger');
            }

        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Menu could not be saved.', 'danger');
        }

        return redirectToQuarxRoute('menus.edit', [$menu->id]);
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
        $menu = $this->menuRepository->findMenuById($id);

        if (empty($menu)) {
            Quarx::notification('Menu not found', 'warning');

            return redirectToQuarxRoute('menus.index');
        }

        $links = $this->linkRepository->getLinksByMenu($menu->id);

        return view('quarx::modules.menus.edit')->with('menu', $menu)->with('links', $links);
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
            $menu = $this->menuRepository->findMenuById($id);

            if (empty($menu)) {
                Quarx::notification('Menu not found', 'warning');

                return redirectToQuarxRoute('menus.index');
            }

            $menu = $this->menuRepository->update($menu, $request->all());
            Quarx::notification('Menu updated successfully.', 'success');

            if (!$menu) {
                Quarx::notification('Menu could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Menu could not be updated.', 'danger');
        }

        return redirectToQuarxRoute('menus.edit', [$id]);
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
        $menu = $this->menuRepository->findMenuById($id);

        if (empty($menu)) {
            Quarx::notification('Menu not found', 'warning');

            return redirectToQuarxRoute('menus.index');
        }

        $menu->delete();

        Quarx::notification('Menu deleted successfully.');

        return redirectToQuarxRoute('menus.index');
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
        $menu = $this->menuRepository->findMenuById($id);
        $result =  $this->menuRepository->setOrder($menu, $request->except('_token'));

        return QuarxResponseService::apiResponse('success', $result);
    }
}
