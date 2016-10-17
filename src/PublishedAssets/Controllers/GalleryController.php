<?php

namespace App\Http\Controllers\Quarx;

use Config;
use App\Http\Controllers\Controller;
use Yab\Quarx\Repositories\ImageRepository;

class GalleryController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepository $imageRepo)
    {
        $this->imageRepository = $imageRepo;
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $images = $this->imageRepository->publishedAndPaginated();
        $tags = $this->imageRepository->allTags();

        if (empty($images)) {
            abort(404);
        }

        return view('quarx-frontend::gallery.all')
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
        $images = $this->imageRepository->getImagesByTag($tag)->paginate(Config::get('quarx.pagination'));
        $tags = $this->imageRepository->allTags();

        if (empty($images)) {
            abort(404);
        }

        return view('quarx-frontend::gallery.show')
            ->with('tags', $tags)
            ->with('images', $images)
            ->with('title', $tag);
    }
}
