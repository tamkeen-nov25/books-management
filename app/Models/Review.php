<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'content'
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the book being reviewed
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user who made the review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
