<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;
use Yab\Quarx\Repositories\BlogRepository;

class BlogController extends Controller
{
    /** @var BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;
    }

    /**
     * Display all Blog entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function all()
    {
        $blogs = $this->blogRepository->publishedAndPaginated();
        $tags = $this->blogRepository->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('quarx-frontend::blog.all')
            ->with('tags', $tags)
            ->with('blogs', $blogs);
    }

    /**
     * Display all Blog entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function tag($tag)
    {
        $blogs = $this->blogRepository->tags($tag);
        $tags = $this->blogRepository->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('quarx-frontend::blog.all')
            ->with('tags', $tags)
            ->with('blogs', $blogs);
    }

    /**
     * Display the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($url)
    {
        $blog = $this->blogRepository->findBlogsByURL($url);

        if (empty($blog)) {
            abort(404);
        }

        return view('quarx-frontend::blog.'.$blog->template)->with('blog', $blog);
    }
}
