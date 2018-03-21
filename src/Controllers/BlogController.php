<?php

namespace Grafite\Cms\Controllers;

use Cms;
use Grafite\Cms\Models\Blog;
use Illuminate\Http\Request;
use Grafite\Cms\Requests\BlogRequest;
use Grafite\Cms\Services\ValidationService;
use Grafite\Cms\Repositories\BlogRepository;

class BlogController extends GrafiteCmsController
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

        return view('cms::modules.blogs.index')
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

        return view('cms::modules.blogs.index')
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
        return view('cms::modules.blogs.create');
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
        $validation = app(ValidationService::class)->check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->repository->store($request->all());
            Cms::notification('Blog saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$blog) {
            Cms::notification('Blog could not be saved.', 'warning');
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
        $blog = $this->repository->find($id);

        if (empty($blog)) {
            Cms::notification('Blog not found', 'warning');

            return redirect(route($this->routeBase.'.blog.index'));
        }

        return view('cms::modules.blogs.edit')->with('blog', $blog);
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
        $blog = $this->repository->find($id);

        if (empty($blog)) {
            Cms::notification('Blog not found', 'warning');

            return redirect(route($this->routeBase.'.blog.index'));
        }

        $validation = app(ValidationService::class)->check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->repository->update($blog, $request->all());

            Cms::notification('Blog updated successfully.', 'success');

            if (! $blog) {
                Cms::notification('Blog could not be saved.', 'warning');
            }
        } else {
            return $validation['redirect'];
        }

        return back();
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
        $blog = $this->repository->find($id);

        if (empty($blog)) {
            Cms::notification('Blog not found', 'warning');

            return redirect(route($this->routeBase.'.blog.index'));
        }

        $blog->delete();

        Cms::notification('Blog deleted successfully.', 'success');

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
        $blog = $this->repository->find($id);

        return view('cms::modules.blogs.history')
            ->with('blog', $blog);
    }
}
