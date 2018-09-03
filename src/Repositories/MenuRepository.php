<?php

namespace Grafite\Cms\Repositories;

use Grafite\Cms\Models\Menu;
use Grafite\Cms\Repositories\CmsRepository;
use Illuminate\Support\Facades\Schema;

class MenuRepository extends CmsRepository
{
    public $model;

    public $table;

    public function __construct(Menu $model)
    {
        $this->model = $model;
        $this->table = config('cms.db-prefix').'menus';
    }

    /**
     * Stores Menu into database.
     *
     * @param array $payload
     *
     * @return Menu
     */
    public function store($payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        return $this->model->create($payload);
    }

    /**
     * Updates Menu into database.
     *
     * @param Menu  $menu
     * @param array $payload
     *
     * @return Menu
     */
    public function update($menu, $payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        return $menu->update($payload);
    }

    /**
     * Set the order
     *
     * @param Menu  $menu
     * @param array $payload
     *
     * @return Menu
     */
    public function setOrder($menu, $payload)
    {
        return $menu->update($payload);
    }
}
