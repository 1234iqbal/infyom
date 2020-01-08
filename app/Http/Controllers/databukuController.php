<?php

namespace App\Http\Controllers;

use App\DataTables\databukuDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedatabukuRequest;
use App\Http\Requests\UpdatedatabukuRequest;
use App\Repositories\databukuRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class databukuController extends AppBaseController
{
    /** @var  databukuRepository */
    private $databukuRepository;

    public function __construct(databukuRepository $databukuRepo)
    {
        $this->databukuRepository = $databukuRepo;
    }

    /**
     * Display a listing of the databuku.
     *
     * @param databukuDataTable $databukuDataTable
     * @return Response
     */
    public function index(databukuDataTable $databukuDataTable)
    {
        return $databukuDataTable->render('databukus.index');
    }

    /**
     * Show the form for creating a new databuku.
     *
     * @return Response
     */
    public function create()
    {
        return view('databukus.create');
    }

    /**
     * Store a newly created databuku in storage.
     *
     * @param CreatedatabukuRequest $request
     *
     * @return Response
     */
    public function store(CreatedatabukuRequest $request)
    {
        $input = $request->all();

        $databuku = $this->databukuRepository->create($input);

        Flash::success('Databuku saved successfully.');

        return redirect(route('databukus.index'));
    }

    /**
     * Display the specified databuku.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $databuku = $this->databukuRepository->find($id);

        if (empty($databuku)) {
            Flash::error('Databuku not found');

            return redirect(route('databukus.index'));
        }

        return view('databukus.show')->with('databuku', $databuku);
    }

    /**
     * Show the form for editing the specified databuku.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $databuku = $this->databukuRepository->find($id);

        if (empty($databuku)) {
            Flash::error('Databuku not found');

            return redirect(route('databukus.index'));
        }

        return view('databukus.edit')->with('databuku', $databuku);
    }

    /**
     * Update the specified databuku in storage.
     *
     * @param  int              $id
     * @param UpdatedatabukuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedatabukuRequest $request)
    {
        $databuku = $this->databukuRepository->find($id);

        if (empty($databuku)) {
            Flash::error('Databuku not found');

            return redirect(route('databukus.index'));
        }

        $databuku = $this->databukuRepository->update($request->all(), $id);

        Flash::success('Databuku updated successfully.');

        return redirect(route('databukus.index'));
    }

    /**
     * Remove the specified databuku from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $databuku = $this->databukuRepository->find($id);

        if (empty($databuku)) {
            Flash::error('Databuku not found');

            return redirect(route('databukus.index'));
        }

        $this->databukuRepository->delete($id);

        Flash::success('Databuku deleted successfully.');

        return redirect(route('databukus.index'));
    }
}
