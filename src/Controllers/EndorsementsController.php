<?php

namespace Grafite\Cms\Controllers;

use Cms;
use Illuminate\Http\Request;
use Grafite\Cms\Models\Endorsement;
use Grafite\Cms\Requests\EndorsementRequest;
use Grafite\Cms\Services\ValidationService;
use Grafite\Cms\Repositories\EndorsementRepository;

class EndorsementsController extends GrafiteCmsController
{
    public function __construct(EndorsementRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Endorsements.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cms::modules.endorsements.index')
            ->with('endorsements', $result)
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

        return view('cms::modules.endorsements.index')
            ->with('endorsement', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Endorsements.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms::modules.endorsements.create');
    }

    /**
     * Store a newly created Endorsements in storage.
     *
     * @param EndorsementRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Endorsement::$rules);

        if (!$validation['errors']) {
            $endorsement = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Cms::notification('Endorsements saved successfully.', 'success');

        return redirect(route($this->routeBase.'.endorsements.edit', [$endorsement->id]));
    }

    /**
     * Show the form for editing the specified Endorsements.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $endorsement = $this->repository->find($id);

        if (empty($endorsement)) {
            Cms::notification('Endorsements not found', 'warning');

            return redirect(route($this->routeBase.'.endorsements.index'));
        }

        return view('cms::modules.endorsements.edit')->with('endorsement', $endorsement);
    }

    /**
     * Update the specified Endorsements in storage.
     *
     * @param int            $id
     * @param EndorsementRequest $request
     *
     * @return Response
     */
    public function update($id, EndorsementRequest $request)
    {
        $endorsement = $this->repository->find($id);

        if (empty($endorsement)) {
            Cms::notification('Endorsements not found', 'warning');

            return redirect(route($this->routeBase.'.endorsements.index'));
        }

        $endorsement = $this->repository->update($endorsement, $request->all());

        Cms::notification('Endorsements updated successfully.', 'success');

        return redirect(url()->previous());
    }

    /**
     * Remove the specified Endorsements from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $endorsement = $this->repository->find($id);

        if (empty($endorsement)) {
            Cms::notification('Endorsements not found', 'warning');

            return redirect(route($this->routeBase.'.endorsements.index'));
        }

        $endorsement->delete();

        Cms::notification('Endorsements deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.endorsements.index'));
    }
}
