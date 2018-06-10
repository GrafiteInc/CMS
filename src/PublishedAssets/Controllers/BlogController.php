<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Grafite\Cms\Repositories\BlogRepository;

class BlogController extends Controller
{
    protected $repository;

    public function __construct(BlogRepository $repository)
    {
        $this->repository = $repository;

        if (!in_array('blog', config('cms.active-core-modules'))) {
            return redirect('/')->send();
        }
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
        $blogs = $this->repository->published();
        $tags = $this->repository->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('cms-frontend::blog.all')
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
        $blogs = $this->repository->tags($tag);
        $tags = $this->repository->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('cms-frontend::blog.all')
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
        $blog = $this->repository->findBlogsByURL($url);

        if (empty($blog)) {
            abort(404);
        }

        return view('cms-frontend::blog.'.$blog->template)->with('blog', $blog);
    }
}
