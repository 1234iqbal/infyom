<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepelangganRequest;
use App\Http\Requests\UpdatepelangganRequest;
use App\Repositories\pelangganRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class pelangganController extends AppBaseController
{
    /** @var  pelangganRepository */
    private $pelangganRepository;

    public function __construct(pelangganRepository $pelangganRepo)
    {
        $this->pelangganRepository = $pelangganRepo;
    }

    /**
     * Display a listing of the pelanggan.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pelanggans = $this->pelangganRepository->all();

        return view('pelanggans.index')
            ->with('pelanggans', $pelanggans);
    }

    /**
     * Show the form for creating a new pelanggan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pelanggans.create');
    }

    /**
     * Store a newly created pelanggan in storage.
     *
     * @param CreatepelangganRequest $request
     *
     * @return Response
     */
    public function store(CreatepelangganRequest $request)
    {
        $input = $request->all();

        $pelanggan = $this->pelangganRepository->create($input);

        Flash::success('Pelanggan saved successfully.');

        return redirect(route('pelanggans.index'));
    }

    /**
     * Display the specified pelanggan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        return view('pelanggans.show')->with('pelanggan', $pelanggan);
    }

    /**
     * Show the form for editing the specified pelanggan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        return view('pelanggans.edit')->with('pelanggan', $pelanggan);
    }

    /**
     * Update the specified pelanggan in storage.
     *
     * @param int $id
     * @param UpdatepelangganRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepelangganRequest $request)
    {
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        $pelanggan = $this->pelangganRepository->update($request->all(), $id);

        Flash::success('Pelanggan updated successfully.');

        return redirect(route('pelanggans.index'));
    }

    /**
     * Remove the specified pelanggan from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        $this->pelangganRepository->delete($id);

        Flash::success('Pelanggan deleted successfully.');

        return redirect(route('pelanggans.index'));
    }
}
