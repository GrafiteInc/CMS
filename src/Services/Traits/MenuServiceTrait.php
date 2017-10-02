<?php

namespace Yab\Quarx\Services\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Yab\Quarx\Repositories\LinkRepository;
use Yab\Quarx\Repositories\MenuRepository;
use Yab\Quarx\Repositories\PageRepository;

trait MenuServiceTrait
{
    /**
     * Quarx package Menus.
     *
     * @return string
     */
    public function packageMenus()
    {
        $packageViews = Config::get('quarx.package-menus', []);

        foreach ($packageViews as $view) {
            include $view;
        }
    }

    /**
     * Get a view.
     *
     * @param string $slug
     * @param View   $view
     *
     * @return string
     */
    public function menu($slug, $view = null)
    {
        $pageRepo = new PageRepository();
        $menu = MenuRepository::getMenuBySLUG($slug)->first();

        if (!$menu) {
            return '';
        }

        $links = LinkRepository::getLinksByMenuID($menu->id);
        $order = json_decode($menu->order);
        // Sort the links by the order from the menu
        $links = $this->sortByKeys($links, $order);

        $response = '';
        $processedLinks = [];
        foreach ($links as $key => $link) {
            if ($link->external) {
                $response .= "<a href=\"$link->external_url\">$link->name</a>";
                $processedLinks[] = "<a href=\"$link->external_url\">$link->name</a>";
            } else {
                $page = $pageRepo->findPagesById($link->page_id);
                if ($page && $page->is_published && $page->published_at <= Carbon::now(config('app.timezone'))) {
                    if (config('app.locale') == config('quarx.default-language', $this->config('quarx.default-language'))) {
                        $response .= '<a href="'.URL::to('page/'.$page->url)."\">$link->name</a>";
                        $processedLinks[] = '<a href="'.URL::to('page/'.$page->url)."\">$link->name</a>";
                    } elseif (config('app.locale') != config('quarx.default-language', $this->config('quarx.default-language'))) {
                        if ($page->translation(config('app.locale'))) {
                            $response .= '<a href="'.URL::to('page/'.$page->translation(config('app.locale'))->data->url)."\">$link->name</a>";
                            $processedLinks[] = '<a href="'.URL::to('page/'.$page->translation(config('app.locale'))->data->url)."\">$link->name</a>";
                        }
                    }
                } else {
                    unset($links[$key]);
                }
            }
        }

        if (!is_null($view)) {
            $response = view($view, ['links' => $links, 'linksAsHtml' => $response, 'processed_links' => $processedLinks]);
        }

        if (Gate::allows('quarx', Auth::user())) {
            $response .= '<a href="'.url(config('quarx.backend-route-prefix', 'quarx').'/menus/'.$menu->id.'/edit').'" style="margin-left: 8px;" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span> Edit</a>';
        }

        return $response;
    }

    /**
     * Sort by an existing set of keys
     *
     * @param  collection $links
     * @param  array $keys
     *
     * @return collection
     */
    public function sortByKeys($links, $keys)
    {
        if (! is_null($keys)) {
            $links = $links->keyBy('id');

            $sortedLinks = [];
            foreach ($keys as $key) {
                $sortedLinks[] = $links[$key];
            }

            return collect($sortedLinks);
        }

        return $links;
    }
}
