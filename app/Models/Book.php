<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'is_available'
    ];

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
}
