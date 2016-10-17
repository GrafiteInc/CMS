<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;
use Yab\Quarx\Repositories\PageRepository;

class PagesController extends Controller
{
    /** @var PagesRepository */
    private $pagesRepository;

    public function __construct(PageRepository $pagesRepo)
    {
        $this->pagesRepository = $pagesRepo;
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
        $page = $this->pagesRepository->findPagesByURL('home');

        $view = view('quarx-frontend::pages.home');

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
        $pages = $this->pagesRepository->published();

        if (empty($pages)) {
            abort(404);
        }

        return view('quarx-frontend::pages.all')->with('pages', $pages);
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
        $page = $this->pagesRepository->findPagesByURL($url);

        if (empty($page)) {
            abort(404);
        }

        return view('quarx-frontend::pages.'.$page->template)->with('page', $page);
    }
}
