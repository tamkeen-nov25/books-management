<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        $book->last_modified_at = now();
        // save without firing observer again
        $book->saveQuietly();

        Log::info('Book updated by observer', ['book_id' => $book->id, 'last_modified_at' => $book->last_modified_at]);
    }
}
