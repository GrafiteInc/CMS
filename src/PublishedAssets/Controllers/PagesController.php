<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;
use Yab\Quarx\Repositories\PagesRepository;

class PagesController extends Controller
{

    /** @var  PagesRepository */
    private $pagesRepository;

    function __construct(PagesRepository $pagesRepo)
    {
        $this->pagesRepository = $pagesRepo;
    }

    /**
     * Homepage
     *
     * @param  string $url
     *
     * @return Response
     */
    public function home()
    {
        $page = $this->pagesRepository->findPagesByURL('home');

        if (empty($page)) abort(404);

        return view('quarx-frontend::pages.home')->with('page', $page);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $pages = $this->pagesRepository->published();

        if (empty($pages)) abort(404);

        return view('quarx-frontend::pages.all')->with('pages', $pages);
    }

    /**
     * Display the specified Page.
     *
     * @param  string $url
     *
     * @return Response
     */
    public function show($url)
    {
        $page = $this->pagesRepository->findPagesByURL($url);

        if (empty($page)) abort(404);

        return view('quarx-frontend::pages.show')->with('page', $page);
    }

}
