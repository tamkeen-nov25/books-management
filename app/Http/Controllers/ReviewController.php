<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    /**
     * Get books that have at least one review using whereHas
     */
    public function getBooksWithReviews()
    {
        $books = Book::whereHas('reviews', function ($query) {
            // This filters books that have at least one review
        })->with('reviews.user')->paginate(15);

        return $this->successResponse($books, 'Books with reviews retrieved successfully');
    }

    /**
     * Get books with high-rated reviews
     */
    public function getBooksWithHighRatings($minRating = 4)
    {
        $books = Book::whereHas('reviews', function ($query) use ($minRating) {
            $query->where('rating', '>=', $minRating);
        })->with('reviews.user')->paginate(15);

        return $this->successResponse($books, 'Books with high ratings retrieved successfully');
    }

    /**
     * Get books without reviews
     */
    public function getBooksWithoutReviews()
    {
        $books = Book::whereDoesntHave('reviews')->paginate(15);

        return $this->successResponse($books, 'Books without reviews retrieved successfully');
    }

    /**
     * Store a new review for a book
     */
    public function store(Book $book, StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['book_id'] = $book->id;

        $review = Review::create($data);

        $review->load('user');

        return $this->successResponse($review, 'Review created successfully');
    }


}
