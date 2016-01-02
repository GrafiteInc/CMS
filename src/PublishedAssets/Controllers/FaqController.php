<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;
use Mlantz\Quarx\Repositories\FaqRepository;

class FaqController extends Controller
{

    /** @var  FaqRepository */
    private $faqRepository;

    function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Display all Faq entries.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function all()
    {
        $faqs = $this->faqRepository->published();

        if (empty($faqs)) abort(404);

        return view('quarx-frontend::faqs.all')->with('faqs', $faqs);
    }

}
