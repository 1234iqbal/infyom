<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBukuAPIRequest;
use App\Http\Requests\API\UpdateBukuAPIRequest;
use App\Models\Buku;
use App\Repositories\BukuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BukuController
 * @package App\Http\Controllers\API
 */

class BukuAPIController extends AppBaseController
{
    /** @var  BukuRepository */
    private $bukuRepository;

    public function __construct(BukuRepository $bukuRepo)
    {
        $this->bukuRepository = $bukuRepo;
    }

    /**
     * Display a listing of the Buku.
     * GET|HEAD /bukus
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $bukus = $this->bukuRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bukus->toArray(), 'Bukus retrieved successfully');
    }

    /**
     * Store a newly created Buku in storage.
     * POST /bukus
     *
     * @param CreateBukuAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBukuAPIRequest $request)
    {
        $input = $request->all();

        $buku = $this->bukuRepository->create($input);

        return $this->sendResponse($buku->toArray(), 'Buku saved successfully');
    }

    /**
     * Display the specified Buku.
     * GET|HEAD /bukus/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Buku $buku */
        $buku = $this->bukuRepository->find($id);

        if (empty($buku)) {
            return $this->sendError('Buku not found');
        }

        return $this->sendResponse($buku->toArray(), 'Buku retrieved successfully');
    }

    /**
     * Update the specified Buku in storage.
     * PUT/PATCH /bukus/{id}
     *
     * @param int $id
     * @param UpdateBukuAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBukuAPIRequest $request)
    {
        $input = $request->all();

        /** @var Buku $buku */
        $buku = $this->bukuRepository->find($id);

        if (empty($buku)) {
            return $this->sendError('Buku not found');
        }

        $buku = $this->bukuRepository->update($input, $id);

        return $this->sendResponse($buku->toArray(), 'Buku updated successfully');
    }

    /**
     * Remove the specified Buku from storage.
     * DELETE /bukus/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Buku $buku */
        $buku = $this->bukuRepository->find($id);

        if (empty($buku)) {
            return $this->sendError('Buku not found');
        }

        $buku->delete();

        return $this->sendSuccess('Buku deleted successfully');
    }
}
