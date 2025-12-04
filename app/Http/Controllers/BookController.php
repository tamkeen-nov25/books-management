<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()->get();
        return $this->successResponse($books, 'Books retrieved successfully');
    }

    public function show($book)
    {
        $bookData = Book::findOrFail($book);
        return $this->successResponse($bookData, 'Book retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'published_year' => ['required', 'integer', 'min:1000', 'max:2025'],
            'is_available' => ['required', 'boolean']
        ]);

        $book = Book::create($validated);

        return $this->successResponse($book, 'Book created successfully');
    }

    public function update(Request $request, $book)
    {
        $bookData = Book::find($book);
        
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'min:3', 'max:255'],
            'author' => ['sometimes', 'string', 'min:3', 'max:255'],
            'published_year' => ['sometimes', 'integer', 'min:1000', 'max:2025'],
            'is_available' => ['sometimes', 'boolean']
        ]);

        $bookData->update($validated);

        return $this->successResponse($bookData, 'Book updated successfully');
    }

    public function destroy($book)
    {
        $bookData = Book::findOrFail($book);
        $bookData->delete();

        return $this->successResponse(['id' => $book], 'Book deleted successfully');
    }
}