<?php

namespace App\Http\Controllers;

use App\DataTables\dataDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedataRequest;
use App\Http\Requests\UpdatedataRequest;
use App\Repositories\dataRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class dataController extends AppBaseController
{
    /** @var  dataRepository */
    private $dataRepository;

    public function __construct(dataRepository $dataRepo)
    {
        $this->dataRepository = $dataRepo;
    }

    /**
     * Display a listing of the data.
     *
     * @param dataDataTable $dataDataTable
     * @return Response
     */
    public function index(dataDataTable $dataDataTable)
    {
        return $dataDataTable->render('data.index');
    }

    /**
     * Show the form for creating a new data.
     *
     * @return Response
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created data in storage.
     *
     * @param CreatedataRequest $request
     *
     * @return Response
     */
    public function store(CreatedataRequest $request)
    {
        $input = $request->all();

        $data = $this->dataRepository->create($input);

        Flash::success('Data saved successfully.');

        return redirect(route('data.index'));
    }

    /**
     * Display the specified data.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = $this->dataRepository->find($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        return view('data.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified data.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->dataRepository->find($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        return view('data.edit')->with('data', $data);
    }

    /**
     * Update the specified data in storage.
     *
     * @param  int              $id
     * @param UpdatedataRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedataRequest $request)
    {
        $data = $this->dataRepository->find($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        $data = $this->dataRepository->update($request->all(), $id);

        Flash::success('Data updated successfully.');

        return redirect(route('data.index'));
    }

    /**
     * Remove the specified data from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->dataRepository->find($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        $this->dataRepository->delete($id);

        Flash::success('Data deleted successfully.');

        return redirect(route('data.index'));
    }
}
