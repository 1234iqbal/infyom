<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepelangganAPIRequest;
use App\Http\Requests\API\UpdatepelangganAPIRequest;
use App\Models\pelanggan;
use App\Repositories\pelangganRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class pelangganController
 * @package App\Http\Controllers\API
 */

class pelangganAPIController extends AppBaseController
{
    /** @var  pelangganRepository */
    private $pelangganRepository;

    public function __construct(pelangganRepository $pelangganRepo)
    {
        $this->pelangganRepository = $pelangganRepo;
    }

    /**
     * Display a listing of the pelanggan.
     * GET|HEAD /pelanggans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pelanggans = $this->pelangganRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($pelanggans->toArray(), 'Pelanggans retrieved successfully');
    }

    /**
     * Store a newly created pelanggan in storage.
     * POST /pelanggans
     *
     * @param CreatepelangganAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepelangganAPIRequest $request)
    {
        $input = $request->all();

        $pelanggan = $this->pelangganRepository->create($input);

        return $this->sendResponse($pelanggan->toArray(), 'Pelanggan saved successfully');
    }

    /**
     * Display the specified pelanggan.
     * GET|HEAD /pelanggans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var pelanggan $pelanggan */
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            return $this->sendError('Pelanggan not found');
        }

        return $this->sendResponse($pelanggan->toArray(), 'Pelanggan retrieved successfully');
    }

    /**
     * Update the specified pelanggan in storage.
     * PUT/PATCH /pelanggans/{id}
     *
     * @param int $id
     * @param UpdatepelangganAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepelangganAPIRequest $request)
    {
        $input = $request->all();

        /** @var pelanggan $pelanggan */
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            return $this->sendError('Pelanggan not found');
        }

        $pelanggan = $this->pelangganRepository->update($input, $id);

        return $this->sendResponse($pelanggan->toArray(), 'pelanggan updated successfully');
    }

    /**
     * Remove the specified pelanggan from storage.
     * DELETE /pelanggans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var pelanggan $pelanggan */
        $pelanggan = $this->pelangganRepository->find($id);

        if (empty($pelanggan)) {
            return $this->sendError('Pelanggan not found');
        }

        $pelanggan->delete();

        return $this->sendSuccess('Pelanggan deleted successfully');
    }
}
