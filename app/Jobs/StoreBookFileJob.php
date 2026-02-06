<?php

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use App\Models\Book;
// use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreBookFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Book $book;
    protected string $path;

    public function __construct(Book $book, string $path)
    {
        $this->book = $book;
        $this->path = $path;
    }

    public function handle(): void
    {

        $fullPath = storage_path('app/' . $this->path);

        //Scanning can take seconds, especially for large files → queue prevents blocking.
        $result = shell_exec("clamscan " . escapeshellarg($fullPath));

        if (str_contains($result, "OK")) {
            // $this->book->update(['is_safe' => true]);
        } else {
            // $this->book->update(['is_safe' => false]);
            // Storage::delete($this->path); // delete infected file
        }
    }
}
