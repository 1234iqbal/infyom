<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Repositories\BooksRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BooksController extends AppBaseController
{
    /** @var  BooksRepository */
    private $booksRepository;

    public function __construct(BooksRepository $booksRepo)
    {
        $this->booksRepository = $booksRepo;
    }

    /**
     * Display a listing of the Books.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $books = $this->booksRepository->all();

        return view('books.index')
            ->with('books', $books);
    }

    /**
     * Show the form for creating a new Books.
     *
     * @return Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created Books in storage.
     *
     * @param CreateBooksRequest $request
     *
     * @return Response
     */
    public function store(CreateBooksRequest $request)
    {
        $input = $request->all();

        $books = $this->booksRepository->create($input);

        Flash::success('Books saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified Books.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $books = $this->booksRepository->find($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('books.index'));
        }

        return view('books.show')->with('books', $books);
    }

    /**
     * Show the form for editing the specified Books.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $books = $this->booksRepository->find($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('books.index'));
        }

        return view('books.edit')->with('books', $books);
    }

    /**
     * Update the specified Books in storage.
     *
     * @param int $id
     * @param UpdateBooksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBooksRequest $request)
    {
        $books = $this->booksRepository->find($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('books.index'));
        }

        $books = $this->booksRepository->update($request->all(), $id);

        Flash::success('Books updated successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified Books from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $books = $this->booksRepository->find($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('books.index'));
        }

        $this->booksRepository->delete($id);

        Flash::success('Books deleted successfully.');

        return redirect(route('books.index'));
    }
}
