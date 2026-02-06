<?php

namespace App\Console\Commands;

use App\Mail\NewBooksSummary;
use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BooksDailySummary extends Command
{
    protected $signature = 'books:daily-summary {hours=24}';

    protected $description = 'Send daily summary of new books added in the last N hours';

    public function handle(): int
    {
        $hours = (int) $this->argument('hours');
        $since = now()->subHours($hours);
        $books = Book::where('created_at', '>=', $since)->get();

        if ($books->isEmpty()) {
            $this->info('No new books in the given period.');
            return 0;
        }

        $list = $books->map(fn($b) => [
            'id' => $b->id,
            'title' => $b->getTranslation('title', 'en'),
            'created_at' => $b->created_at->toDateTimeString(),
        ])->toArray();

        $adminEmail = config('mail.admin_email') ?: env('ADMIN_EMAIL');
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new NewBooksSummary($list));
        }

        $this->info('Summary emailed.');
        return 0;
    }
}
