<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Grafite\Cms\Repositories\FAQRepository;

class FaqController extends Controller
{
    protected $repository;

    public function __construct(FAQRepository $repository)
    {
        $this->repository = $repository;

        if (!in_array('faqs', config('cms.active-core-modules'))) {
            return redirect('/')->send();
        }
    }

    /**
     * Display all Faq entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function all()
    {
        $faqs = $this->repository->published();

        if (empty($faqs)) {
            abort(404);
        }

        return view('cms-frontend::faqs.all')->with('faqs', $faqs);
    }
}
