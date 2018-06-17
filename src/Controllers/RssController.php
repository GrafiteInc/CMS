<?php

namespace Grafite\Cms\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RssController extends GrafiteCmsController
{
    protected $repo;

    public function __construct(Request $request)
    {
        parent::construct();

        $url = $request->segment(1) ?? 'page';

        $this->module = str_singular($url);

        if (! empty($this->module)) {
            $this->repo = app('Grafite\Cms\Repositories\\'.ucfirst($this->module).'Repository');
        }
    }

    public function index()
    {
        $module = $this->module;

        $meta = config('cms.rss', [
            'title' => config('app.name'),
            'link' => url('/'),
        ]);

        $items = $this->repo->published();

        $contents = view('cms::rss', compact('items', 'meta', 'module'));

        return new Response($contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
        ]);
    }
}
