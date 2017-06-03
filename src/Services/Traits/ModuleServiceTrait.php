<?php

namespace Yab\Quarx\Services\Traits;

use Illuminate\Support\Facades\Config;
use Yab\Quarx\Facades\CryptoServiceFacade;

trait ModuleServiceTrait
{
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
        $assetPath = base_path(Config::get('quarx.module-directory').'/'.ucfirst($module).'/Assets/'.$path);

        if (!is_file($assetPath)) {
            $assetPath = config('quarx.modules.'.$module.'.asset_path').'/'.$path;
        }

        return url(config('quarx.backend-route-prefix', 'quarx').'/asset/'.CryptoServiceFacade::url_encode($assetPath).'/'.CryptoServiceFacade::url_encode($contentType).'/?isModule=true');
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
        $configArray = @include base_path(Config::get('quarx.module-directory').'/'.ucfirst($module).'/config.php');

        if (!$configArray) {
            return config('quarx.modules.'.$module.'.'.$path);
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
    public function moduleLinks($ignoredModules = [])
    {
        $links = '';

        $modules = config('quarx.modules', []);

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
                $links .= '<li><a href="'.url($link).'">'.ucfirst($link).'</a></li>';
            }
        }

        return $links;
    }
}
