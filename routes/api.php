<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use App\Mail\NewBooksSummary;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::get('/{book}', [BookController::class, 'show']);
    Route::put('/{book}', [BookController::class, 'update']);
    Route::delete('/{book}', [BookController::class, 'destroy']);
});

// Comments Routes
Route::prefix('comments')->group(function () {
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{comment}', [CommentController::class, 'show']);
    Route::delete('/{comment}', [CommentController::class, 'destroy']);
    Route::get('/book/{book}', [CommentController::class, 'getBookComments']);
    Route::get('/category/{category}', [CommentController::class, 'getCategoryComments']);
    Route::get('/search/by-title', [CommentController::class, 'searchCommentsByTitle'])->name('comments.search');
});

// Get books with comments (using whereHasMorph)
Route::get('/books-with-comments', [CommentController::class, 'getBooksWithComments']);
Route::get('/categories-with-comments', [CommentController::class, 'getCategoriesWithComments']);

// Reviews Routes (using whereHas)
Route::prefix('reviews')->group(function () {
    Route::get('/with-reviews', [ReviewController::class, 'getBooksWithReviews']);
    Route::get('/high-ratings/{minRating?}', [ReviewController::class, 'getBooksWithHighRatings']);
    Route::get('/without-reviews', [ReviewController::class, 'getBooksWithoutReviews']);
    Route::get('/book/{book}/stats', [ReviewController::class, 'getBookReviewStats']);
    Route::post('/book/{book}', [ReviewController::class, 'store']);
});


Route::get('test',function(){
    return new NewBooksSummary(Book::all()->toArray());
});
