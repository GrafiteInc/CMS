<?php

namespace Yab\Quarx\Models;

use Log;
use Yab\Quarx\Models\Archive;
use Illuminate\Database\Eloquent\Model;

class QuarxModel extends Model
{
    public function afterSaved($payload)
    {
        unset($payload->attributes['created_at']);
        unset($payload->attributes['updated_at']);
        unset($payload->original['created_at']);
        unset($payload->original['updated_at']);

        if ($payload->attributes != $payload->original) {
            Archive::create([
                'token'         => md5(time()),
                'entity_id'     => $payload->attributes['id'],
                'entity_type'   => get_class($payload),
                'entity_data'   => json_encode($payload->attributes)
            ]);
            Log::info(get_class($payload).' #'.$payload->attributes['id'].' was archived');
        }
    }

}
