<?php

namespace graphite\Quarx\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use graphite\Quarx\Models\Link;

class QuarxModel extends Model
{
    /**
     * Model contructuor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (config('quarx.db-prefix', '')) {
            $this->table = config('quarx.db-prefix', '').$this->table;
        }
    }

    /**
     * After the item is saved to the database.
     *
     * @param object $payload
     */
    public function afterSaved($payload)
    {
        if (!request()->is('quarx/revert/*') && !request()->is('quarx/rollback/*/*')) {
            unset($payload->attributes['created_at']);
            unset($payload->attributes['updated_at']);
            unset($payload->original['created_at']);
            unset($payload->original['updated_at']);

            if ($payload->attributes != $payload->original) {
                Archive::create([
                    'token' => md5(time()),
                    'entity_id' => $payload->attributes['id'],
                    'entity_type' => get_class($payload),
                    'entity_data' => json_encode($payload->attributes),
                ]);
                Log::info(get_class($payload).' #'.$payload->attributes['id'].' was archived');
            }
        }
    }

    /**
     * When the item is being deleted.
     *
     * @param object $payload
     */
    public function beingDeleted($payload)
    {
        $type = get_class($payload);
        $id = $payload->id;

        Translation::where('entity_id', $id)->where('entity_type', $type)->delete();
        Archive::where('entity_id', $id)->where('entity_type', $type)->delete();

        Archive::where('entity_type', 'graphite\Quarx\Models\Translation')
            ->where('entity_data', 'LIKE', '%"entity_id":'.$id.'%')
            ->where('entity_data', 'LIKE', '%"entity_type":"'.$type.'"%')
            ->delete();

        if ($type == 'graphite\Quarx\Models\Page') {
            Link::where('page_id', $id)->delete();
        }
    }

    /**
     * A method for getting / setting blocks
     *
     * @param  string $slug
     * @return string
     */
    public function block($slug)
    {
        $block = $this->findABlock($slug);

        if (!$block) {
            $this->update([
                'blocks' => json_encode(array_merge($this->blocks, [ $slug => '' ]))
            ]);
        }

        return $block;
    }

    /**
     * Find a block based on slug
     *
     * @param  string $slug
     * @return string
     */
    public function findABlock($slug)
    {
        if (isset($this->blocks[$slug])) {
            return $this->blocks[$slug];
        }

        return false;
    }
}
