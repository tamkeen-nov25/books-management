<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category');
    }

    /**
     * Get all comments for this category
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
