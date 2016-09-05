<?php

namespace Yab\Quarx\Repositories;

use Illuminate\Support\Facades\Schema;
use Yab\Quarx\Models\Menu;

class MenuRepository
{
    /**
     * Returns all Menus.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Menu::orderBy('created_at', 'desc')->get();
    }

    /**
     * Returns all paginated Menus.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        return Menu::orderBy('created_at', 'desc')->paginate(25);
    }

    /**
     * Search Menu.
     *
     * @param string $input
     *
     * @return Menu
     */
    public function search($input)
    {
        $query = Menu::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('menus');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(25)->render()];
    }

    /**
     * Stores Menu into database.
     *
     * @param array $input
     *
     * @return Menu
     */
    public function store($input)
    {
        return Menu::create($input);
    }

    /**
     * Find Menu by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Menu
     */
    public function findMenuById($id)
    {
        return Menu::find($id);
    }

    /**
     * Find Menu by given slug.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Menu
     */
    public static function getMenuBySLUG($id)
    {
        return Menu::where('slug', $id)->get();
    }

    /**
     * Updates Menu into database.
     *
     * @param Menu  $menu
     * @param array $input
     *
     * @return Menu
     */
    public function update($menu, $input)
    {
        return $menu->update($input);
    }
}
