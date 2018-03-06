<?php

namespace Yab\Cabin\Controllers;

use URL;
use Cabin;
use Yab\Cabin\Models\FAQ;
use Illuminate\Http\Request;
use Yab\Cabin\Requests\FAQRequest;
use Yab\Cabin\Repositories\FAQRepository;
use Yab\Cabin\Services\ValidationService;

class FAQController extends CabinController
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

        return view('cabin::modules.faqs.index')
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

        return view('cabin::modules.faqs.index')
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
        return view('cabin::modules.faqs.create');
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
        $validation = ValidationService::check(FAQ::$rules);

        if (!$validation['errors']) {
            $faq = $this->repository->store($request->all());
            Cabin::notification('FAQ saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$faq) {
            Cabin::notification('FAQ could not be saved.', 'warning');
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
        $faq = $this->repository->findFAQById($id);

        if (empty($faq)) {
            Cabin::notification('FAQ not found', 'warning');

            return redirect(route($this->routeBase.'.faqs.index'));
        }

        return view('cabin::modules.faqs.edit')->with('faq', $faq);
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
        $faq = $this->repository->findFAQById($id);

        if (empty($faq)) {
            Cabin::notification('FAQ not found', 'warning');

            return redirect(route($this->routeBase.'.faqs.index'));
        }

        $validation = ValidationService::check(FAQ::$rules);

        if (!$validation['errors']) {
            $faq = $this->repository->update($faq, $request->all());
            Cabin::notification('FAQ updated successfully.', 'success');

            if (!$faq) {
                Cabin::notification('FAQ could not be saved.', 'warning');
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
        $faq = $this->repository->findFAQById($id);

        if (empty($faq)) {
            Cabin::notification('FAQ not found', 'warning');

            return redirect(route($this->routeBase.'.faqs.index'));
        }

        $faq->delete();

        Cabin::notification('FAQ deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.faqs.index'));
    }
}
