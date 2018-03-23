<?php

namespace Grafite\Cms\Services\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Grafite\Cms\Repositories\WidgetRepository;
use Grafite\Cms\Services\FileService;

trait DefaultModuleServiceTrait
{
    public function defaultModules()
    {
        return [
            'blog',
            'menus',
            'files',
            'images',
            'pages',
            'widgets',
            'events',
            'faqs',
        ];
    }

    /**
     * Get a widget.
     *
     * @param string $slug
     *
     * @return widget
     */
    public function widget($slug)
    {
        $widget = app(WidgetRepository::class)->getBySlug($slug);

        if ($widget) {
            if (Gate::allows('cms', Auth::user())) {
                $widget->content .= '<a href="'.url(config('cms.backend-route-prefix', 'cms').'/widgets/'.$widget->id.'/edit').'" class="btn btn-sm ml-2 btn-outline-secondary"><span class="fa fa-edit"></span> Edit</a>';
            }

            if (config('app.locale') !== config('cms.default-language') && $widget->translation(config('app.locale'))) {
                return $widget->translationData(config('app.locale'))->content;
            } else {
                return $widget->content;
            }
        }

        return '';
    }

    /**
     * Get image.
     *
     * @param string $tag
     *
     * @return collection
     */
    public function image($id, $class = '')
    {
        $img = '';

        if ($image = app('Grafite\Cms\Models\Image')->find($id)) {
            $img = $image->url;
        }

        return '<img class="'.$class.'" src="'.$img.'">';
    }

    /**
     * Get image link.
     *
     * @param string $tag
     *
     * @return collection
     */
    public function imageLink($id)
    {
        $img = '';

        if ($image = app('Grafite\Cms\Models\Image')->find($id)) {
            $img = $image->url;
        }

        return $img;
    }

    /**
     * Get images.
     *
     * @param string $tag
     *
     * @return collection
     */
    public function images($tag = null)
    {
        $images = [];

        if (is_array($tag)) {
            foreach ($tag as $tagName) {
                $images = array_merge($images, $this->imageRepo->getImagesByTag($tag)->get()->toArray());
            }
        } elseif (is_null($tag)) {
            $images = array_merge($images, $this->imageRepo->getImagesByTag()->get()->toArray());
        } else {
            $images = array_merge($images, $this->imageRepo->getImagesByTag($tag)->get()->toArray());
        }

        return $images;
    }
}
