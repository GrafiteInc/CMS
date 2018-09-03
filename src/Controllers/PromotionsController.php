<?php

namespace Grafite\Cms\Controllers;

use Cms;
use Illuminate\Http\Request;
use Grafite\Cms\Models\Promotion;
use Grafite\Cms\Requests\PromotionRequest;
use Grafite\Cms\Services\ValidationService;
use Grafite\Cms\Repositories\PromotionRepository;

class PromotionsController extends GrafiteCmsController
{
    public function __construct(PromotionRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Promotions.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cms::modules.promotions.index')
            ->with('promotions', $result)
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

        return view('cms::modules.promotions.index')
            ->with('promotion', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Promotions.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms::modules.promotions.create');
    }

    /**
     * Store a newly created Promotions in storage.
     *
     * @param PromotionRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Promotion::$rules);

        if (!$validation['errors']) {
            $promotion = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Cms::notification('Promotions saved successfully.', 'success');

        return redirect(route($this->routeBase.'.promotions.edit', [$promotion->id]));
    }

    /**
     * Show the form for editing the specified Promotions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promotion = $this->repository->find($id);

        if (empty($promotion)) {
            Cms::notification('Promotions not found', 'warning');

            return redirect(route($this->routeBase.'.promotions.index'));
        }

        return view('cms::modules.promotions.edit')->with('promotion', $promotion);
    }

    /**
     * Update the specified Promotions in storage.
     *
     * @param int            $id
     * @param PromotionRequest $request
     *
     * @return Response
     */
    public function update($id, PromotionRequest $request)
    {
        $promotion = $this->repository->find($id);

        if (empty($promotion)) {
            Cms::notification('Promotions not found', 'warning');

            return redirect(route($this->routeBase.'.promotions.index'));
        }

        $promotion = $this->repository->update($promotion, $request->all());

        Cms::notification('Promotions updated successfully.', 'success');

        return redirect(url()->previous());
    }

    /**
     * Remove the specified Promotions from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promotion = $this->repository->find($id);

        if (empty($promotion)) {
            Cms::notification('Promotions not found', 'warning');

            return redirect(route($this->routeBase.'.promotions.index'));
        }

        $promotion->delete();

        Cms::notification('Promotions deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.promotions.index'));
    }
}
