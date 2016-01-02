<?php

namespace Mlantz\Quarx\Controllers;

use Quarx;
use CryptoService;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mlantz\Quarx\Models\Menu;
use Mlantz\Quarx\Requests\CreateMenuRequest;
use Mlantz\Quarx\Services\ValidationService;
use Mlantz\Quarx\Repositories\MenuRepository;
use Mlantz\Quarx\Repositories\LinksRepository;

class MenuController extends QuarxController
{

    /** @var  MenuRepository */
    private $menuRepository;

    function __construct(MenuRepository $menuRepo, LinksRepository $linkRepo)
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
     * Search
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
     * @param CreateMenuRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validation = ValidationService::check(Menu::$rules);

            if ( ! $validation['errors']) {
                $menu = $this->menuRepository->store($request->all());
                Quarx::notification('Menu saved successfully.', 'success');

                if (! $menu) {
                    Quarx::notification('Menu could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Menu could not be saved.', 'danger');
        }

        return redirect(route('quarx.menus.index'));
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $id = CryptoService::decrypt($id);
        $menu = $this->menuRepository->findMenuById($id);

        if (empty($menu)) {
            Quarx::notification('Menu not found', 'warning');
            return redirect(route('quarx.menus.index'));
        }

        $links = $this->linkRepository->getLinksByMenu($menu->id);
        return view('quarx::modules.menus.edit')->with('menu', $menu)->with('links', $links);
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param  int    $id
     * @param CreateMenuRequest $request
     *
     * @return Response
     */
    public function update($id, CreateMenuRequest $request)
    {
        try {
            $id = CryptoService::decrypt($id);
            $menu = $this->menuRepository->findMenuById($id);

            if (empty($menu)) {
                Quarx::notification('Menu not found', 'warning');
                return redirect(route('quarx.menus.index'));
            }

            $menu = $this->menuRepository->update($menu, $request->all());
            Quarx::notification('Menu updated successfully.', 'success');

            if (! $menu) {
                Quarx::notification('Menu could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Menu could not be updated.', 'danger');
        }

        return redirect(route('quarx.menus.edit', [CryptoService::encrypt($id)]));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $id = CryptoService::decrypt($id);
        $menu = $this->menuRepository->findMenuById($id);

        if (empty($menu)) {
            Quarx::notification('Menu not found', 'warning');
            return redirect(route('quarx.menus.index'));
        }

        $menu->delete();

        Quarx::notification('Menu deleted successfully.');

        return redirect(route('quarx.menus.index'));
    }

}
