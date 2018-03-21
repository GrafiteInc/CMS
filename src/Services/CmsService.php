<?php

namespace Grafite\Cms\Services;

use Grafite\Cms\Facades\CryptoServiceFacade;
use Grafite\Cms\Repositories\ImageRepository;
use Grafite\Cms\Services\Traits\DefaultModuleServiceTrait;
use Grafite\Cms\Services\Traits\MenuServiceTrait;
use Grafite\Cms\Services\Traits\ModuleServiceTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CmsService
{
    use MenuServiceTrait,
        DefaultModuleServiceTrait,
        ModuleServiceTrait;

    public function __construct()
    {
        $this->imageRepo = app(ImageRepository::class);
    }

    /**
     * Get a module's asset.
     *
     * @param string $module      Module name
     * @param string $path        Path to module asset
     * @param string $contentType Asset type
     *
     * @return string
     */
    public function asset($path, $contentType = 'null', $fullURL = true)
    {
        if (!$fullURL) {
            return base_path(__DIR__.'/../Assets/'.$path);
        }

        return url(config('cms.backend-route-prefix', 'cms').'/asset/'.CryptoServiceFacade::url_encode($path).'/'.CryptoServiceFacade::url_encode($contentType));
    }

    /**
     * Get a file download response
     *
     * @param  string $fileName
     * @param  string $realFileName
     *
     * @return Response
     */
    public function fileAsDownload($fileName, $realFileName)
    {
        return app(FileService::class)->fileAsDownload($fileName, $realFileName);
    }

    /**
     * Generates a notification for the app.
     *
     * @param string $string Notification string
     * @param string $type   Notification type
     */
    public function notification($string, $type = null)
    {
        if (is_null($type)) {
            $type = 'info';
        }

        Session::flash('notification', $string);
        Session::flash('notificationType', 'alert-'.$type);
    }

    /**
     * Creates a breadcrumb trail.
     *
     * @param array $locations Locations array
     *
     * @return string
     */
    public function breadcrumbs($locations)
    {
        $trail = '';

        foreach ($locations as $location) {
            if (is_array($location)) {
                foreach ($location as $key => $value) {
                    $trail .= '<li class="breadcrumb-item"><a href="'.$value.'">'.ucfirst($key).'</a></li>';
                }
            } else {
                $trail .= '<li class="breadcrumb-item">'.ucfirst($location).'</li>';
            }
        }

        return $trail;
    }

    /**
     * Get Module Config.
     *
     * @param string $key Config key
     *
     * @return mixed
     */
    public function config($key)
    {
        $splitKey = explode('.', $key);

        $moduleConfig = include __DIR__.'/../PublishedAssets/Config/'.$splitKey[0].'.php';

        $strippedKey = preg_replace('/'.$splitKey[1].'./', '', preg_replace('/'.$splitKey[0].'./', '', $key, 1), 1);

        return $moduleConfig[$strippedKey];
    }

    /**
     * Assign a value to the path.
     *
     * @param array  &$arr Original Array of values
     * @param string $path Array as path string
     *
     * @return mixed
     */
    public function assignArrayByPath(&$arr, $path)
    {
        $keys = explode('.', $path);

        while ($key = array_shift($keys)) {
            $arr = &$arr[$key];
        }

        return $arr;
    }

    /**
     * Convert a string to a URL.
     *
     * @param string $string
     *
     * @return string
     */
    public function convertToURL($string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($string)));
    }

    /**
     * Add these views to the packages.
     *
     * @param string $dir
     */
    public function addToPackages($dir)
    {
        $files = glob($dir.'/*');

        $packageViews = Config::get('cms.package-menus');

        if (is_null($packageViews)) {
            $packageViews = [];
        }

        foreach ($files as $view) {
            array_push($packageViews, $view);
        }

        return Config::set('cms.package-menus', $packageViews);
    }

    /**
     * Edit button.
     *
     * @param string $type
     * @param int    $id
     * @param string $class
     *
     * @return string
     */
    public function editBtn($type = null, $id = null, $class="btn-link")
    {
        if (Gate::allows('cms', Auth::user())) {
            if (!is_null($id)) {
                return '<a href="'.url(config('cms.backend-route-prefix', 'cms').'/'.$type.'/'.$id.'/edit').'" class="btn btn-sm '.$class.'"><span class="fa fa-edit"></span> Edit</a>';
            } else {
                return '<a href="'.url(config('cms.backend-route-prefix', 'cms').'/'.$type).'" class="btn btn-sm '.$class.'"><span class="fa fa-edit"></span> Edit</a>';
            }
        }

        return '';
    }

    /**
     * Grafite CMS url generator - handles custom cms url
     *
     * @param  string $string
     *
     * @return string
     */
    public function url($string)
    {
        $url = str_replace('.', '/', $string);

        return url(config('cms.backend-route-prefix', 'cms').'/'.$url);
    }

    /**
     * Grafite CMS route generator
     *
     * @param  string $string
     *
     * @return string
     */
    public function route($string)
    {
        return config('cms.backend-route-prefix', 'cms').'.'.$string;
    }

    /**
     * Another form of the edit button
     *
     * @param string $type
     * @param int    $id
     * @param string $class
     *
     * @return string
     */
    public function editBtnSecondary($type = null, $id = null)
    {
        return $this->editBtn($type, $id, 'btn-secondary');
    }

    /**
     * Rollback URL.
     *
     * @param obj $object
     *
     * @return string
     */
    public function rollbackUrl($object)
    {
        $class = str_replace('\\', '_', get_class($object));

        return url(config('cms.backend-route-prefix', 'cms').'/rollback/'.$class.'/'.$object->id);
    }

    /**
     * Get version from the changelog.
     *
     * @return string
     */
    public function version()
    {
        $changelog = @file_get_contents(__DIR__.'/../../changelog.md');

        if (!$changelog) {
            return 'unknown version';
        }

        $matches = strstr($changelog, '## [');
        $until = strpos($matches, '-');

        return str_replace(']', '', substr($matches, 5, $until - 5));
    }
}
