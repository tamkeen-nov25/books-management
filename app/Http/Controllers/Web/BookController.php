<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'published_year' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'is_available' => ['required', 'boolean']
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    public function show($book)
    {
        $bookData = Book::findOrFail($book);
        return view('books.show', compact('bookData'));
    }

    public function edit($book)
    {
        $bookData = Book::findOrFail($book);
        return view('books.edit', compact('bookData'));
    }

    public function update(Request $request, $book)
    {
        $bookData = Book::findOrFail($book);
        
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'min:3', 'max:255'],
            'author' => ['sometimes', 'string', 'min:3', 'max:255'],
            'published_year' => ['sometimes', 'integer', 'min:1000', 'max:' . date('Y')],
            'is_available' => ['sometimes', 'boolean']
        ]);

        $bookData->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($book)
    {
        $bookData = Book::findOrFail($book);
        $bookData->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}