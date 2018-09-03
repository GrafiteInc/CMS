<?php

namespace Grafite\Cms\Services\Traits;

use Grafite\Cms\Repositories\PromotionRepository;
use Grafite\Cms\Repositories\WidgetRepository;
use Grafite\Cms\Services\FileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

trait DefaultModuleServiceTrait
{
    public $imageRepo;

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
            'promotions',
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
     * Get an promotion.
     *
     * @param string $slug
     *
     * @return promotion
     */
    public function promotion($slug)
    {
        $promotion = app(PromotionRepository::class)->getBySlug($slug);

        if ($promotion) {
            if (Gate::allows('cms', Auth::user())) {
                $promotion->details .= '<a href="'.url(config('cms.backend-route-prefix', 'cms').'/promotions/'.$promotion->id.'/edit').'" style="margin-left: 8px;" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span> Edit</a>';
            }

            if ($promotion->is_published) {
                if (config('app.locale') !== config('cms.default-language') && $promotion->translation(config('app.locale'))) {
                    return $promotion->translationData(config('app.locale'))->details;
                } else {
                    return $promotion->details;
                }
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
