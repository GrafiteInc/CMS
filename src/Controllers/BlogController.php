<?php

namespace Yab\Quarx\Controllers;

use URL;
use Quarx;
use Yab\Quarx\Models\Blog;
use Illuminate\Http\Request;
use Yab\Quarx\Requests\BlogRequest;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\BlogRepository;

class BlogController extends QuarxController
{
    /** @var BlogRepository */
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        parent::construct();

        $this->blogRepository = $blogRepo;
    }

    /**
     * Display a listing of the Blog.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = $this->blogRepository->paginated();

        return view('quarx::modules.blogs.index')
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

        $result = $this->blogRepository->search($input);

        return view('quarx::modules.blogs.index')
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
        return view('quarx::modules.blogs.create');
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
            $blog = $this->blogRepository->store($request->all());
            Quarx::notification('Blog saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$blog) {
            Quarx::notification('Blog could not be saved.', 'warning');
        }

        return redirect(route($this->quarxRouteBase.'.blog.edit', [$blog->id]));
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
        $blog = $this->blogRepository->findBlogById($id);

        if (empty($blog)) {
            Quarx::notification('Blog not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.blog.index'));
        }

        return view('quarx::modules.blogs.edit')->with('blog', $blog);
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
        $blog = $this->blogRepository->findBlogById($id);

        if (empty($blog)) {
            Quarx::notification('Blog not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.blog.index'));
        }

        $validation = ValidationService::check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->blogRepository->update($blog, $request->all());

            Quarx::notification('Blog updated successfully.', 'success');

            if (! $blog) {
                Quarx::notification('Blog could not be saved.', 'warning');
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
        $blog = $this->blogRepository->findBlogById($id);

        if (empty($blog)) {
            Quarx::notification('Blog not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.blog.index'));
        }

        $blog->delete();

        Quarx::notification('Blog deleted successfully.', 'success');

        return redirect(route($this->quarxRouteBase.'.blog.index'));
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
        $blog = $this->blogRepository->findBlogById($id);

        return view('quarx::modules.blogs.history')
            ->with('blog', $blog);
    }
}
