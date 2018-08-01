<?php

namespace Grafite\Cms\Services\Traits;

use Illuminate\Support\Facades\Config;
use Grafite\Cms\Facades\CryptoServiceFacade;

trait ModuleServiceTrait
{
    /**
     * Determine the module based on URL
     *
     * @return string
     */
    public function getModule()
    {
        $module = request()->segment(1);

        $defaultModules = config('cms.active-core-modules');
        $extraModules = array_keys(config('cms.modules', []));

        $modules = array_merge($defaultModules, $extraModules);

        if (in_array($module, $modules)) {
            return str_singular($module);
        }

        return 'page';
    }

    /**
     * Module Assets.
     *
     * @param string $module      Module name
     * @param string $path        Asset path
     * @param string $contentType Content type
     *
     * @return string
     */
    public function moduleAsset($module, $path, $contentType = 'null')
    {
        $assetPath = base_path(Config::get('cms.module-directory').'/'.ucfirst($module).'/Assets/'.$path);

        if (!is_file($assetPath)) {
            $assetPath = config('cms.modules.'.$module.'.asset_path').'/'.$path;
        }

        return url(config('cms.backend-route-prefix', 'cms').'/asset/'.CryptoServiceFacade::url_encode($assetPath).'/'.CryptoServiceFacade::url_encode($contentType).'/?isModule=true');
    }

    /**
     * Module Config.
     *
     * @param string $module      Module name
     * @param string $path        Asset path
     * @param string $contentType Content type
     *
     * @return string
     */
    public function moduleConfig($module, $path)
    {
        $configArray = @include base_path(Config::get('cms.module-directory').'/'.ucfirst($module).'/config.php');

        if (!$configArray) {
            return config('cms.modules.'.$module.'.'.$path);
        }

        return self::assignArrayByPath($configArray, $path);
    }

    /**
     * Module Links.
     *
     * @param array $ignoredModules   A list of ignored links
     *
     * @return string
     */
    public function moduleLinks($ignoredModules = [], $linkClass = 'nav-link', $listClass = 'nav-item')
    {
        $links = '';

        $modules = config('cms.modules', []);

        foreach ($ignoredModules as $ignoredModule) {
            if (in_array(strtolower($ignoredModule), array_keys($modules))) {
                unset($modules[strtolower($ignoredModule)]);
            }
        }

        foreach ($modules as $module => $config) {
            $link = $module;

            if (isset($config['url'])) {
                $link = $config['url'];
            }

            $displayLink = true;

            if (isset($config['is_ignored_in_menu']) && $config['is_ignored_in_menu']) {
                $displayLink = false;
            }

            if ($displayLink) {
                $links .= '<li class="'.$listClass.'"><a class="'.$linkClass.'" href="'.url($link).'">'.ucfirst($link).'</a></li>';
            }
        }

        return $links;
    }
}
