<?php

namespace Mlantz\Quarx\Controllers;

use Quarx;
use CryptoService;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mlantz\Quarx\Models\FAQ;
use Mlantz\Quarx\Requests\CreateFAQRequest;
use Mlantz\Quarx\Services\ValidationService;
use Mlantz\Quarx\Repositories\FAQRepository;

class FAQController extends QuarxController
{

    /** @var  FAQRepository */
    private $faqRepository;

    function __construct(FAQRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the FAQ.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->faqRepository->paginated();

        return view('quarx::modules.faqs.index')
            ->with('faqs', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->faqRepository->search($input);

        return view('quarx::modules.faqs.index')
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
        return view('quarx::modules.faqs.create');
    }

    /**
     * Store a newly created FAQ in storage.
     *
     * @param CreateFAQRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(FAQ::$rules);

        if ( ! $validation['errors']) {
            $faq = $this->faqRepository->store($request->all());
            Quarx::notification('FAQ saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (! $faq) {
            Quarx::notification('FAQ could not be saved.', 'warning');
        }

        return redirect(route('quarx.faqs.edit', [CryptoService::encrypt($faq->id)]));
    }

    /**
     * Show the form for editing the specified FAQ.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $id = CryptoService::decrypt($id);
        $faq = $this->faqRepository->findFAQById($id);

        if (empty($faq)) {
            Quarx::notification('FAQ not found', 'warning');
            return redirect(route('quarx.faqs.index'));
        }

        return view('quarx::modules.faqs.edit')->with('faq', $faq);
    }

    /**
     * Update the specified FAQ in storage.
     *
     * @param  int    $id
     * @param CreateFAQRequest $request
     *
     * @return Response
     */
    public function update($id, CreateFAQRequest $request)
    {
        $id = CryptoService::decrypt($id);
        $faq = $this->faqRepository->findFAQById($id);

        if (empty($faq)) {
            Quarx::notification('FAQ not found', 'warning');
            return redirect(route('quarx.faqs.index'));
        }

        $faq = $this->faqRepository->update($faq, $request->all());
        Quarx::notification('FAQ updated successfully.', 'success');

        if (! $faq) {
            Quarx::notification('FAQ could not be saved.', 'warning');
        }

        return redirect(route('quarx.faqs.edit', [CryptoService::encrypt($id)]));
    }

    /**
     * Remove the specified FAQ from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $id = CryptoService::decrypt($id);
        $faq = $this->faqRepository->findFAQById($id);

        if (empty($faq)) {
            Quarx::notification('FAQ not found', 'warning');
            return redirect(route('quarx.faqs.index'));
        }

        $faq->delete();

        Quarx::notification('FAQ deleted successfully.', 'success');

        return redirect(route('quarx.faqs.index'));
    }

}
