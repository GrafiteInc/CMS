<?php

namespace Grafite\Cms\Traits;

use Grafite\Cms\Models\Translation;
use Grafite\Cms\Services\CmsService;
use Stichoza\GoogleTranslate\TranslateClient;
use Grafite\Cms\Repositories\TranslationRepository;

trait Translatable
{
    /**
     * Get a translation.
     *
     * @param string $lang
     *
     * @return mixed
     */
    public function translation($lang)
    {
        $result = Translation::where('entity_id', $this->id)
            ->where('entity_type', get_class($this))
            ->where('language', $lang)
            ->first();

        if ($result) {
            return $result;
        }

        $this->data = $this;

        return $this;
    }

    /**
     * Get translation data.
     *
     * @param string $lang
     *
     * @return array|null
     */
    public function translationData($lang)
    {
        $translation = $this->translation($lang);

        if ($translation) {
            $data = json_decode($translation->entity_data);

            if (isset($data->blocks)) {
                $data->blocks = json_decode($data->blocks, true);
            }

            return $data;
        }

        return null;
    }

    /**
     * Get a translations attribute.
     *
     * @return array
     */
    public function getTranslationsAttribute()
    {
        $translationData = [];
        $translations = Translation::where('entity_id', $this->id)->where('entity_type', get_class($this))->get();

        foreach ($translations as $translation) {
            $translationData[] = $translation->data->attributes;
        }

        return $translationData;
    }

    /**
     * After the item is created in the database.
     *
     * @param object $payload
     */
    public function afterCreate($payload)
    {
        if (config('cms.auto-translate', false)) {
            $entry = $payload->toArray();

            unset($entry['created_at']);
            unset($entry['updated_at']);
            unset($entry['translations']);
            unset($entry['is_published']);
            unset($entry['published_at']);
            unset($entry['id']);

            foreach (config('cms.languages') as $code => $language) {
                if ($code != config('cms.default-language')) {
                    $translateClient = new TranslateClient(config('cms.default-language'), $code);
                    $translation = [
                        'lang' => $code,
                        'template' => 'show',
                    ];

                    foreach ($entry as $key => $value) {
                        $translation[$key] = $value;

                        if (!empty($value)) {
                            $translation[$key] = json_decode(json_encode($translateClient->translate(strip_tags($value))));
                        }
                    }

                    // not the biggest fan of this but it works
                    if (empty($translation['blocks'])) {
                        $translation['blocks'] = "{}";
                    }

                    if (isset($translation['url'])) {
                        $translation['url'] = app(CmsService::class)->convertToURL($translation['url']);
                    }

                    $entityId = $payload->id;
                    $entityType = get_class($payload);
                    app(TranslationRepository::class)->createOrUpdate($entityId, $entityType, $code, $translation);
                }
            }
        }
    }
}
