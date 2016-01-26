<?php

namespace Yab\Quarx\Controllers;

use URL;
use View;
use Quarx;
use CryptoService;
use Yab\Quarx\Models\Archive;

class QuarxFeatureController extends QuarxController
{
    public function rollback($entity, $id)
    {
        $modelString = 'Yab\Quarx\Models\\'.ucfirst($entity);

        if (! class_exists($modelString)) {
            $modelString = 'Yab\Quarx\Models\\'.ucfirst($entity).'s';
        }

        $model = new $modelString;
        $modelInstance = $model->find(CryptoService::decrypt($id));

        $archive = Archive::where('entity_id', CryptoService::decrypt($id))->where('entity_type', $modelString)->limit(1)->offset(1)->orderBy('id', 'desc')->first();

        if (! $archive) {
            Quarx::notification('Could not rollback', 'warning');
            return redirect(URL::previous());
        }
        $archiveData = (array) json_decode($archive->entity_data);

        $modelInstance->fill($archiveData);
        $modelInstance->save();

        Quarx::notification('Rollback was successful', 'success');
        return redirect(URL::previous());
    }

    public function preview($entity, $id)
    {
        $modelString = 'Yab\Quarx\Models\\'.ucfirst($entity);

        if (! class_exists($modelString)) {
            $modelString = 'Yab\Quarx\Models\\'.ucfirst($entity).'s';
        }

        $model = new $modelString;
        $modelInstance = $model->find(CryptoService::decrypt($id));

        $data = [
            $entity => $modelInstance
        ];

        $view = 'quarx-frontend::'.$entity.'.show';

        if (! View::exists($view)) {
            $view = 'quarx-frontend::'.$entity.'s.show';
        }

        return view($view, $data);
    }
}