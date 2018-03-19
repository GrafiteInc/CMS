<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Grafite\Cms\Repositories\PageRepository;

class PagesController extends Controller
{
    protected $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Homepage.
     *
     * @param string $url
     *
     * @return Response
     */
    public function home()
    {
        $page = $this->repository->findPagesByURL('home');

        $view = view('cms-frontend::pages.home');

        if (is_null($page)) {
            return $view;
        }

        return $view->with('page', $page);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $pages = $this->repository->published();

        if (empty($pages)) {
            abort(404);
        }

        return view('cms-frontend::pages.all')->with('pages', $pages);
    }

    /**
     * Display the specified Page.
     *
     * @param string $url
     *
     * @return Response
     */
    public function show($url)
    {
        $page = $this->repository->findPagesByURL($url);

        if (empty($page)) {
            abort(404);
        }

        return view('cms-frontend::pages.'.$page->template)->with('page', $page);
    }
}
