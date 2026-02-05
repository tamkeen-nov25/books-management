<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function index()
    {
        $books = Book::query()->get();
        return $books;
    }

    public function store(array $data)
    {
        $book = Book::create($data);
        return $book;
    }

    public function update(Book $book, array $data)
    {
        $book->update($data);
    }
}
