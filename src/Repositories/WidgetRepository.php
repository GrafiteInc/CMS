<?php

namespace Grafite\Cms\Repositories;

use Grafite\Cms\Models\Widget;
use Grafite\Cms\Repositories\CmsRepository;
use Grafite\Cms\Repositories\TranslationRepository;

class WidgetRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Widget $model, TranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = config('cms.db-prefix').'widgets';
    }

    /**
     * Stores Widgets into database.
     *
     * @param array $payload
     *
     * @return Widgets
     */
    public function store($payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        return $this->model->create($payload);
    }

    /**
     * Updates Widget in the database
     *
     * @param Widgets $widget
     * @param array $payload
     *
     * @return Widgets
     */
    public function update($widget, $payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        if (!empty($payload['lang']) && $payload['lang'] !== config('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($widget->id, 'Grafite\Cms\Models\Widget', $payload['lang'], $payload);
        } else {
            unset($payload['lang']);

            return $widget->update($payload);
        }
    }
}
