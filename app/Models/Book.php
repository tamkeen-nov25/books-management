<?php

namespace App\Models;

use App\Observers\BookObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

#[ObservedBy(BookObserver::class)]
class Book extends Model
{
    use HasTranslations, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'author',
        'published_year',
        'is_available',
        'file_path',
        'average_rating',
        'last_modified_at'
    ];

    public $translatable = ['title', 'description'];

    protected $casts = [
        'published_year' => 'integer',
        'is_available' => 'boolean',
        'average_rating' => 'float',
        'last_modified_at' => 'datetime'
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
