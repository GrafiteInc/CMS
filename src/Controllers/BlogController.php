<?php

namespace Yab\Cabin\Controllers;

use URL;
use Cabin;
use Yab\Cabin\Models\Blog;
use Illuminate\Http\Request;
use Yab\Cabin\Requests\BlogRequest;
use Yab\Cabin\Services\ValidationService;
use Yab\Cabin\Repositories\BlogRepository;

class BlogController extends CabinController
{
    public function __construct(BlogRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Blog.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = $this->repository->paginated();

        return view('cabin::modules.blogs.index')
            ->with('blogs', $blogs)
            ->with('pagination', $blogs->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->repository->search($input);

        return view('cabin::modules.blogs.index')
            ->with('blogs', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        return view('cabin::modules.blogs.create');
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->repository->store($request->all());
            Cabin::notification('Blog saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$blog) {
            Cabin::notification('Blog could not be saved.', 'warning');
        }

        return redirect(route($this->routeBase.'.blog.edit', [$blog->id]));
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->repository->findBlogById($id);

        if (empty($blog)) {
            Cabin::notification('Blog not found', 'warning');

            return redirect(route($this->routeBase.'.blog.index'));
        }

        return view('cabin::modules.blogs.edit')->with('blog', $blog);
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param int         $id
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function update($id, BlogRequest $request)
    {
        $blog = $this->repository->findBlogById($id);

        if (empty($blog)) {
            Cabin::notification('Blog not found', 'warning');

            return redirect(route($this->routeBase.'.blog.index'));
        }

        $validation = ValidationService::check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->repository->update($blog, $request->all());

            Cabin::notification('Blog updated successfully.', 'success');

            if (! $blog) {
                Cabin::notification('Blog could not be saved.', 'warning');
            }
        } else {
            return $validation['redirect'];
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = $this->repository->findBlogById($id);

        if (empty($blog)) {
            Cabin::notification('Blog not found', 'warning');

            return redirect(route($this->routeBase.'.blog.index'));
        }

        $blog->delete();

        Cabin::notification('Blog deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.blog.index'));
    }

    /**
     * Blog history.
     *
     * @param int $id
     *
     * @return Response
     */
    public function history($id)
    {
        $blog = $this->repository->findBlogById($id);

        return view('cabin::modules.blogs.history')
            ->with('blog', $blog);
    }
}
