<?php

namespace App\Http\Controllers\Cabin;

use Config;
use App\Http\Controllers\Controller;
use Yab\Cabin\Repositories\ImageRepository;

class GalleryController extends Controller
{
    protected $repository;

    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $images = $this->repository->publishedAndPaginated();
        $tags = $this->repository->allTags();

        if (empty($images)) {
            abort(404);
        }

        return view('cabin-frontend::gallery.all')
            ->with('tags', $tags)
            ->with('images', $images);
    }

    /**
     * Display the specified Gallery.
     *
     * @param string $url
     *
     * @return Response
     */
    public function show($tag)
    {
        $images = $this->repository->getImagesByTag($tag)->paginate(Config::get('cabin.pagination'));
        $tags = $this->repository->allTags();

        if (empty($images)) {
            abort(404);
        }

        return view('cabin-frontend::gallery.show')
            ->with('tags', $tags)
            ->with('images', $images)
            ->with('title', $tag);
    }
}
