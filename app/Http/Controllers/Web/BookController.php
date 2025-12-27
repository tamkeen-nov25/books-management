<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
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
        $categories = \App\Models\Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'published_year' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'is_available' => ['required', 'boolean'],
            'cover_color' => ['nullable', 'string', 'max:255'],
            'cover_format' => ['nullable', 'integer', 'in:1,2,3'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id']
        ]);

        $book = Book::create($validated);

        if ($request->has('cover_color') && $request->has('cover_format')) {
        }
        $book->cover()->create([
            'color' => $request->cover_color,
            'format' => $request->cover_format
        ]);
        if ($request->has('categories')) {
            $book->categories()->attach($request->categories);
        }

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
        $categories = Category::all();
        return view('books.edit', compact('bookData', 'categories'));
    }

    public function update(Request $request, $book)
    {
        $bookData = Book::findOrFail($book);

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'min:3', 'max:255'],
            'author' => ['sometimes', 'string', 'min:3', 'max:255'],
            'published_year' => ['sometimes', 'integer', 'min:1000', 'max:' . date('Y')],
            'is_available' => ['sometimes', 'boolean'],
            'cover_color' => ['nullable', 'string', 'max:255'],
            'cover_format' => ['nullable', 'integer', 'in:1,2,3'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id']
        ]);

        $bookData->update($validated);

        if ($request->has('cover_color') && $request->has('cover_format')) {
            $bookData->cover()->updateOrCreate([], [
                'color' => $request->cover_color,
                'format' => $request->cover_format
            ]);
        }

        if ($request->has('categories')) {
            $bookData->categories()->sync($request->categories);
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($book)
    {
        $bookData = Book::findOrFail($book);
        $bookData->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
