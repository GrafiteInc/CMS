<?php

namespace Yab\Quarx\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Quarx;
use Yab\Quarx\Models\Archive;

class QuarxFeatureController extends QuarxController
{
    public function sendHome()
    {
        return redirect('/');
    }

    /**
     * Rollback to a previous version of an entity, a specific moment.
     *
     * @param int $id
     *
     * @return Redirect
     */
    public function revert($id)
    {
        $archive = Archive::find($id);

        $model = app($archive->entity_type);
        $modelInstance = $model->find($archive->entity_id);

        $archiveData = (array) json_decode($archive->entity_data);

        $modelInstance->fill($archiveData);
        $modelInstance->save();

        Quarx::notification('Reversion was successful', 'success');

        return redirect(URL::previous());
    }

    /**
     * Rollback to a previous version of an entity.
     *
     * @param string $entity
     * @param int    $id
     *
     * @return Redirect
     */
    public function rollback($entity, $id)
    {
        $modelString = str_replace('_', '\\', $entity);

        if (!class_exists($modelString)) {
            Quarx::notification('Could not rollback Model not found', 'warning');

            return redirect(URL::previous());
        }

        $model = app($modelString);
        $modelInstance = $model->find($id);

        $archive = Archive::where('entity_id', $id)->where('entity_type', $modelString)->limit(1)->offset(1)->orderBy('id', 'desc')->first();

        if (!$archive) {
            Quarx::notification('Could not rollback', 'warning');

            return redirect(URL::previous());
        }
        $archiveData = (array) json_decode($archive->entity_data);

        $modelInstance->fill($archiveData);
        $modelInstance->save();

        Quarx::notification('Rollback was successful', 'success');

        return redirect(URL::previous());
    }

    /**
     * Preview content.
     *
     * @param string $entity
     * @param int    $id
     *
     * @return Response
     */
    public function preview($entity, $id)
    {
        $modelString = 'Yab\Quarx\Models\\'.ucfirst($entity);

        if (!class_exists($modelString)) {
            $modelString = 'Yab\Quarx\Models\\'.ucfirst($entity).'s';
        }

        $model = new $modelString();
        $modelInstance = $model->find($id);

        $data = [
            $entity => $modelInstance,
        ];

        if (request('lang') != config('quarx.default-language', Quarx::config('quarx.default-language'))) {
            if ($modelInstance->translation(request('lang'))) {
                $data = [
                    $entity => $modelInstance->translation(request('lang'))->data,
                ];
            }
        }

        $view = 'quarx-frontend::'.$entity.'.show';

        if (!View::exists($view)) {
            $view = 'quarx-frontend::'.$entity.'s.show';
        }

        if ($entity === 'page') {
            $view = 'quarx-frontend::pages.'.$modelInstance->template;
        }

        if ($entity === 'blog') {
            $view = 'quarx-frontend::blog.'.$modelInstance->template;
        }

        return view($view, $data);
    }

    /**
     * Set the default lanugage for the session.
     *
     * @param Request $request
     * @param string  $lang
     */
    public function setLanguage(Request $request, $lang)
    {
        return back()->withCookie('language', $lang);
    }
}
