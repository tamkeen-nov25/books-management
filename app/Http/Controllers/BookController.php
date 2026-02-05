<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()->paginate(15);
        return $this->successResponse(BookResource::collection($books)->response()->getData(), 'Books retrieved successfully');
    }

    public function show($book)
    {
        $bookData = Book::findOrFail($book);
        return $this->successResponse(new BookResource($bookData), 'Book retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'array'],
            'title.en' => ['required', 'string', 'min:3', 'max:255'],
            'title.ar' => ['required', 'string', 'min:3', 'max:255'],

            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.ar' => ['nullable', 'string'],

            'author' => ['required', 'string', 'min:3', 'max:255'],
            'published_year' => ['required', 'integer', 'min:1000', 'max:2025'],
            'is_available' => ['required', 'boolean'],
        ]);

        $book = Book::create($validated);

        return $this->successResponse(new BookResource($book), 'Book created successfully');
    }

    public function update(Request $request, $book)
    {
        $bookData = Book::find($book);

        $validated = $request->validate([
            'title' => ['sometimes', 'array'],
            'title.en' => ['sometimes', 'string', 'min:3', 'max:255'],
            'title.ar' => ['sometimes', 'string', 'min:3', 'max:255'],

            'description' => ['sometimes', 'array'],
            'description.en' => ['sometimes', 'string'],
            'description.ar' => ['sometimes', 'string'],

            'author' => ['sometimes', 'string', 'min:3', 'max:255'],
            'published_year' => ['sometimes', 'integer', 'min:1000', 'max:2025'],
            'is_available' => ['sometimes', 'boolean'],
        ]);

        $bookData->update($validated);

        return $this->successResponse(new BookResource($bookData), 'Book updated successfully');
    }

    public function destroy($book)
    {
        $bookData = Book::findOrFail($book);
        $bookData->delete();

        return $this->successResponse(['id' => $book], 'Book deleted successfully');
    }
}
