<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Quarx;
use Yab\Quarx\Models\Translation;

class TranslationRepository
{
    public function __construct(Translation $translation)
    {
        $this->model = $translation;
    }

    public function createOrUpdate($entityId, $entityType, $payload)
    {
        $translation = $this->model->firstOrCreate([
            'entity_id' => $entityId,
            'entity_type' => $entityType
        ]);

        unset($payload['_method']);
        unset($payload['_token']);

        $translation->entity_data = json_encode($payload);

        return $translation->save();
    }

    public function findByUrl($url, $type)
    {
        $item = $this->model->where('entity_type', $type)->where('entity_data->url', $url)->first();

        if ($item && ($item->data->is_published == 1 || $item->data->is_published == 'on') && $item->data->published_at <= Carbon::now()->format('Y-m-d h:i:s')) {
            return $item->data;
        }

        return null;
    }

    public function getEntitiesByTypeAndLang($lang, $type)
    {
        $entities = collect();
        $collection = $this->model->where('entity_type', $type)->where('entity_data->lang', $lang)->get();

        foreach ($collection as $item) {
            $instance = app($item->type)->attributes = $item->data;
            $entities->push($instance);
        }

        return $entities;
    }
}
