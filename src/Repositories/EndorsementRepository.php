<?php

namespace Grafite\Cms\Repositories;

use Grafite\Cms\Models\Endorsement;
use Grafite\Cms\Repositories\CmsRepository;
use Grafite\Cms\Repositories\TranslationRepository;

class EndorsementRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Endorsement $model, TranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = config('cms.db-prefix').'endorsements';
    }

    /**
     * Stores Endorsements into database.
     *
     * @param array $payload
     *
     * @return Endorsements
     */
    public function store($payload)
    {
        $payload['slug'] = str_slug($payload['slug']);

        return $this->model->create($payload);
    }

    /**
     * Updates Endorsement in the database
     *
     * @param Endorsements $widget
     * @param array $payload
     *
     * @return Endorsements
     */
    public function update($widget, $payload)
    {
        $payload['slug'] = str_slug($payload['slug']);

        if (!empty($payload['lang']) && $payload['lang'] !== config('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($widget->id, 'Grafite\Cms\Models\Endorsement', $payload['lang'], $payload);
        } else {
            unset($payload['lang']);

            return $widget->update($payload);
        }
    }
}
