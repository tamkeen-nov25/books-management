<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(protected BookService $bookService) {}
    public function index()
    {
        // $books = Book::query()->get();
        $books = $this->bookService->index();
        return $this->successResponse($books, 'Books retrieved successfully');
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Display the specified book
     *
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    /*******  477b8d32-9717-46a6-b816-a9dfa18ed3bf  *******/
    public function show($book)
    {
        $bookData = Book::findOrFail($book);
        return $this->successResponse($bookData, 'Book retrieved successfully');
    }

    public function store(StoreBookRequest $request)
    {
        // $book = Book::create($request->validated());
        $book = $this->bookService->store($request->validated());

        return $this->successResponse($book, 'Book created successfully');
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->bookService->update($book, $request->validated());

        return $this->successResponse($book, 'Book updated successfully');
    }

    public function destroy($book)
    {
        $bookData = Book::findOrFail($book);
        $bookData->delete();

        return $this->successResponse(['id' => $book], 'Book deleted successfully');
    }
}
