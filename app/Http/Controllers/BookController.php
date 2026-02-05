<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // public function __construct(protected BookService $bookService) {}
    public function index()
    {
        $books = Book::query()->paginate(15);
        return $this->successResponse(BookResource::collection($books)->response()->getData(), 'Books retrieved successfully');
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Display the specified book
     *
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    /*******  477b8d32-9717-46a6-b816-a9dfa18ed3bf  *******/
    public function show(Book $book)
    {
        return $this->successResponse(new BookResource($book), 'Book retrieved successfully');
    }

    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create($validated);

        return $this->successResponse(new BookResource($book), 'Book created successfully');
    }

    public function update(UpdateBookRequest $request, Book $book)
    {

        $validated = $request->validated();

        $book->update($validated);

        return $this->successResponse(new BookResource($book), 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return $this->successResponse(['id' => $book], 'Book deleted successfully');
    }
}
