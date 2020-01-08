<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetokoRequest;
use App\Http\Requests\UpdatetokoRequest;
use App\Repositories\tokoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class tokoController extends AppBaseController
{
    /** @var  tokoRepository */
    private $tokoRepository;

    public function __construct(tokoRepository $tokoRepo)
    {
        $this->tokoRepository = $tokoRepo;
    }

    /**
     * Display a listing of the toko.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tokos = $this->tokoRepository->all();

        return view('tokos.index')
            ->with('tokos', $tokos);
    }

    /**
     * Show the form for creating a new toko.
     *
     * @return Response
     */
    public function create()
    {
        return view('tokos.create');
    }

    /**
     * Store a newly created toko in storage.
     *
     * @param CreatetokoRequest $request
     *
     * @return Response
     */
    public function store(CreatetokoRequest $request)
    {
        $input = $request->all();

        $toko = $this->tokoRepository->create($input);

        Flash::success('Toko saved successfully.');

        return redirect(route('tokos.index'));
    }

    /**
     * Display the specified toko.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            Flash::error('Toko not found');

            return redirect(route('tokos.index'));
        }

        return view('tokos.show')->with('toko', $toko);
    }

    /**
     * Show the form for editing the specified toko.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            Flash::error('Toko not found');

            return redirect(route('tokos.index'));
        }

        return view('tokos.edit')->with('toko', $toko);
    }

    /**
     * Update the specified toko in storage.
     *
     * @param int $id
     * @param UpdatetokoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetokoRequest $request)
    {
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            Flash::error('Toko not found');

            return redirect(route('tokos.index'));
        }

        $toko = $this->tokoRepository->update($request->all(), $id);

        Flash::success('Toko updated successfully.');

        return redirect(route('tokos.index'));
    }

    /**
     * Remove the specified toko from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $toko = $this->tokoRepository->find($id);

        if (empty($toko)) {
            Flash::error('Toko not found');

            return redirect(route('tokos.index'));
        }

        $this->tokoRepository->delete($id);

        Flash::success('Toko deleted successfully.');

        return redirect(route('tokos.index'));
    }
}
