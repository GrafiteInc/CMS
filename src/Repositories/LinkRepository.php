<?php

namespace Grafite\Cms\Repositories;

use Grafite\Cms\Models\Link;
use Grafite\Cms\Repositories\CmsRepository;

class LinkRepository extends CmsRepository
{
    public $model;

    public $table;

    public function __construct(Link $model)
    {
        $this->model = $model;

        $this->table = 'links';
    }

    /**
     * Stores Links into database.
     *
     * @param array $payload
     *
     * @return Links
     */
    public function store($payload)
    {
        $payload['external'] = isset($payload['external']) ? $payload['external'] : 0;

        if (!isset($payload['page_id'])) {
            $payload['page_id'] = 0;
        }

        return $this->model->create($payload);
    }

    /**
     * Find Links by menu id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Links
     */
    public function getLinksByMenu($id)
    {
        return $this->model->where('menu_id', $id)->get();
    }

    /**
     * Updates Links into database.
     *
     * @param Links $links
     * @param array $payload
     *
     * @return Links
     */
    public function update($link, $payload)
    {
        $payload['external'] = isset($payload['external']) ? $payload['external'] : 0;

        return $link->update($payload);
    }
}
