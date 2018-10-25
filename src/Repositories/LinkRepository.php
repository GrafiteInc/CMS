<?php

namespace Grafite\Cms\Repositories;

use Exception;
use Grafite\Cms\Models\Link;
use Grafite\Cms\Repositories\CmsRepository;
use Grafite\Cms\Repositories\TranslationRepository;

class LinkRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Link $model, TranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->table = config('cms.db-prefix').'links';
        $this->translationRepo = $translationRepo;
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

        if ($payload['external'] != 0 && empty($payload['external_url'])) {
            throw new Exception("Your link was missing a URL", 1);
        }

        if (!isset($payload['page_id'])) {
            $payload['page_id'] = 0;
        }

        if ($payload['page_id'] == 0 && $payload['external'] == 0) {
            throw new Exception("Your link was not connected to anything, and could not be made", 1);
        }

        $link = $this->model->create($payload);

        $order = json_decode($link->menu->order);
        array_push($order, $link->id);
        $link->menu->update([
            'order' => json_encode($order),
        ]);

        return $link;
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
     * @param Link  $link
     * @param array $input
     *
     * @return Link
     */
    public function update($link, $payload)
    {
        $payload['external'] = isset($payload['external']) ? $payload['external'] : 0;

        if (!empty($payload['lang']) && $payload['lang'] !== config('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($link->id, 'Grafite\Cms\Models\Link', $payload['lang'], $payload);
        }

        unset($payload['lang']);

        return $link->update($payload);
    }
}
