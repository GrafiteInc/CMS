<?php

namespace Yab\Cabin\Traits;

use Yab\Cabin\Models\Translation;
use Yab\Cabin\Services\CabinService;
use Stichoza\GoogleTranslate\TranslateClient;
use Yab\Cabin\Repositories\TranslationRepository;

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
        return Translation::where('entity_id', $this->id)
            ->where('entity_type', get_class($this))
            ->where('entity_data', 'LIKE', '%"lang":"'.$lang.'"%')
            ->first();
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
        if (config('cabin.auto-translate', false)) {
            $entry = $payload->toArray();

            unset($entry['created_at']);
            unset($entry['updated_at']);
            unset($entry['translations']);
            unset($entry['is_published']);
            unset($entry['published_at']);
            unset($entry['id']);

            foreach (config('cabin.languages') as $code => $language) {
                if ($code != config('cabin.default-language')) {
                    $tr = new TranslateClient(config('cabin.default-language'), $code);
                    $translation = [
                        'lang' => $code,
                        'template' => 'show',
                    ];

                    foreach ($entry as $key => $value) {
                        if (!empty($value)) {
                            $translation[$key] = json_decode(json_encode($tr->translate(strip_tags($value))));
                        } else {
                            $translation[$key] = $value;
                        }
                    }

                    // not the biggest fan of this but it works
                    if (empty($translation['blocks'])) {
                        $translation['blocks'] = "{}";
                    }

                    if (isset($translation['url'])) {
                        $translation['url'] = app(CabinService::class)->convertToURL($translation['url']);
                    }

                    $entityId = $payload->id;
                    $entityType = get_class($payload);
                    app(TranslationRepository::class)->createOrUpdate($entityId, $entityType, $code, $translation);
                }
            }
        }
    }
}
