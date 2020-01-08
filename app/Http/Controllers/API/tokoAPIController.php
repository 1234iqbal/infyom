<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetokoAPIRequest;
use App\Http\Requests\API\UpdatetokoAPIRequest;
use App\Models\toko;
use App\Repositories\tokoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class tokoController
 * @package App\Http\Controllers\API
 */

class tokoAPIController extends AppBaseController
{
    /** @var  tokoRepository */
    private $tokoRepository;

    public function __construct(tokoRepository $tokoRepo)
    {
        $this->tokoRepository = $tokoRepo;
    }

    /**
     * Display a listing of the toko.
     * GET|HEAD /tokos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tokos = $this->tokoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tokos->toArray(), 'Tokos retrieved successfully');
    }

    /**
     * Store a newly created toko in storage.
     * POST /tokos
     *
     * @param CreatetokoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetokoAPIRequest $request)
    {
        $input = $request->all();

        $toko = $this->tokoRepository->create($input);

        return $this->sendResponse($toko->toArray(), 'Toko saved successfully');
    }

    /**
     * Display the specified toko.
     * GET|HEAD /tokos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var toko $toko */
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            return $this->sendError('Toko not found');
        }

        return $this->sendResponse($toko->toArray(), 'Toko retrieved successfully');
    }

    /**
     * Update the specified toko in storage.
     * PUT/PATCH /tokos/{id}
     *
     * @param int $id
     * @param UpdatetokoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetokoAPIRequest $request)
    {
        $input = $request->all();

        /** @var toko $toko */
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            return $this->sendError('Toko not found');
        }

        $toko = $this->tokoRepository->update($input, $id);

        return $this->sendResponse($toko->toArray(), 'toko updated successfully');
    }

    /**
     * Remove the specified toko from storage.
     * DELETE /tokos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var toko $toko */
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            return $this->sendError('Toko not found');
        }

        $toko->delete();

        return $this->sendSuccess('Toko deleted successfully');
    }
}
