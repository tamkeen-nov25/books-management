<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBooksSummary extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $books;

    public function __construct(array $books)
    {
        $this->books = $books;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily New Books Summary',
        );
    }
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new_books_summary',
            with: [
                'books' => $this->books,
            ],
        );
    }
}
