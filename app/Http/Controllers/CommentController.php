<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created comment in storage
     */
    public function store(StoreCommentRequest $request)
    {
        $newComment = $this->commentService->createComment($request->validated());

        return $this->successResponse($newComment, 'Comment created successfully');
    }

    /**
     * Display the specified comment
     */
    public function show(Comment $comment)
    {
        $comment = $this->commentService->getCommentById($comment);

        return $this->successResponse($comment, 'Comment retrieved successfully');
    }

    /**
     * Delete the specified comment
     */
    public function destroy(Comment $comment)
    {
        $result = $this->commentService->deleteComment($comment);

        return $this->successResponse($result, 'Comment deleted successfully');
    }

    /**
     * Get comments for a specific book
     */
    public function getBookComments(Book $book)
    {
        $comments = $this->commentService->getBookComments($book);

        return $this->successResponse($comments, 'Book comments retrieved successfully');
    }

    /**
     * Get comments for a specific category
     */
    public function getCategoryComments(Category $category)
    {
        $comments = $this->commentService->getCategoryComments($category);

        return $this->successResponse($comments, 'Category comments retrieved successfully');
    }

    /**
     * Get books that have comments using whereHas
     */
    public function getBooksWithComments()
    {
        $books = $this->commentService->getBooksWithComments();

        return $this->successResponse($books, 'Books with comments retrieved successfully');
    }

    /**
     * Get categories that have comments using whereHas
     */
    public function getCategoriesWithComments()
    {
        $categories = $this->commentService->getCategoriesWithComments();

        return $this->successResponse($categories, 'Categories with comments retrieved successfully');
    }

    /**
     * Get comments by category name or book title
     */
    public function searchCommentsByTitle(SearchCommentRequest $request)
    {
        $page = request()->get('page', 1);
        $comments = $this->commentService->searchCommentsByTitle(
            $request->validated()['search'],
            $page
        );

        return $this->successResponse($comments, 'Comments retrieved successfully');
    }
}
