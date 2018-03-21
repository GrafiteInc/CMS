<?php

namespace Grafite\Cms\Controllers;

use URL;
use Cms;
use Grafite\Cms\Models\FAQ;
use Illuminate\Http\Request;
use Grafite\Cms\Requests\FAQRequest;
use Grafite\Cms\Repositories\FAQRepository;
use Grafite\Cms\Services\ValidationService;

class FAQController extends GrafiteCmsController
{
    public function __construct(FAQRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the FAQ.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cms::modules.faqs.index')
            ->with('faqs', $result)
            ->with('pagination', $result->render());
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

        return view('cms::modules.faqs.index')
            ->with('faqs', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new FAQ.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms::modules.faqs.create');
    }

    /**
     * Store a newly created FAQ in storage.
     *
     * @param FAQRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(FAQ::$rules);

        if (!$validation['errors']) {
            $faq = $this->repository->store($request->all());
            Cms::notification('FAQ saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$faq) {
            Cms::notification('FAQ could not be saved.', 'warning');
        }

        return redirect(route($this->routeBase.'.faqs.edit', [$faq->id]));
    }

    /**
     * Show the form for editing the specified FAQ.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faq = $this->repository->find($id);

        if (empty($faq)) {
            Cms::notification('FAQ not found', 'warning');

            return redirect(route($this->routeBase.'.faqs.index'));
        }

        return view('cms::modules.faqs.edit')->with('faq', $faq);
    }

    /**
     * Update the specified FAQ in storage.
     *
     * @param int        $id
     * @param FAQRequest $request
     *
     * @return Response
     */
    public function update($id, FAQRequest $request)
    {
        $faq = $this->repository->find($id);

        if (empty($faq)) {
            Cms::notification('FAQ not found', 'warning');

            return redirect(route($this->routeBase.'.faqs.index'));
        }

        $validation = app(ValidationService::class)->check(FAQ::$rules);

        if (!$validation['errors']) {
            $faq = $this->repository->update($faq, $request->all());
            Cms::notification('FAQ updated successfully.', 'success');

            if (!$faq) {
                Cms::notification('FAQ could not be saved.', 'warning');
            }
        } else {
            return $validation['redirect'];
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified FAQ from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faq = $this->repository->find($id);

        if (empty($faq)) {
            Cms::notification('FAQ not found', 'warning');

            return redirect(route($this->routeBase.'.faqs.index'));
        }

        $faq->delete();

        Cms::notification('FAQ deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.faqs.index'));
    }
}
