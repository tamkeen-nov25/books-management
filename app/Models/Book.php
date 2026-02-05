<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'author',
        'published_year',
        'is_available'
    ];

    public $translatable = ['title', 'description'];

    protected $casts = [
        'published_year' => 'integer',
        'is_available' => 'boolean'
    ];

    public function cover()
    {
        return $this->hasOne(Cover::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    /**
     * Get all comments for this book
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get reviews for this book
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
