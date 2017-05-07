<?php

namespace Yab\Quarx\Repositories;

use Carbon\Carbon;
use Yab\Quarx\Models\Translation;

class TranslationRepository
{
    public function __construct(Translation $translation)
    {
        $this->model = $translation;
    }

    public function createOrUpdate($entityId, $entityType, $lang, $payload)
    {
        $translation = $this->model->firstOrCreate([
            'entity_id' => $entityId,
            'entity_type' => $entityType,
            'language' => $lang,
        ]);

        unset($payload['_method']);
        unset($payload['_token']);

        $translation->entity_data = json_encode($payload);

        return $translation->save();
    }

    public function findByUrl($url, $type)
    {
        $item = $this->model->where('entity_type', $type)->where('entity_data', 'LIKE', '%"url":"'.$url.'"%')->first();

        if ($item && ($item->data->is_published == 1 || $item->data->is_published == 'on') && $item->data->published_at <= Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s')) {
            return $item->data;
        }

        return null;
    }

    public function findByEntityId($entityId, $entityType)
    {
        $item = $this->model->where('entity_type', $entityType)->where('entity_id', $entityId)->first();

        if ($item && ($item->data->is_published == 1 || $item->data->is_published == 'on') && $item->data->published_at <= Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s')) {
            return $item->data;
        }

        return null;
    }

    public function getEntitiesByTypeAndLang($lang, $type)
    {
        $entities = collect();
        $collection = $this->model->where('entity_type', $type)->where('entity_data', 'LIKE', '%"lang":"'.$lang.'"%')->get();

        foreach ($collection as $item) {
            $instance = app($item->type)->attributes = $item->data;
            $entities->push($instance);
        }

        return $entities;
    }
}
