<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Pagination\Paginator;

class CommentService
{
    /**
     * Create a new comment
     */
    public function createComment(array $data): Comment
    {
        // Map simple type names to full class names
        $typeMap = [
            'book' => 'App\\Models\\Book',
            'category' => 'App\\Models\\Category',
        ];

        // Cast the commentable_type to full class name
        $data['commentable_type'] = $typeMap[$data['commentable_type']];

        return Comment::create($data);
    }

    /**
     * Get comment by ID
     */
    public function getCommentById(Comment $comment): Comment
    {
        return $comment;
    }

    /**
     * Delete a comment
     */
    public function deleteComment(Comment $comment): array
    {
        $id = $comment->id;
        $comment->delete();

        return ['id' => $id];
    }

    /**
     * Get comments for a specific book
     */
    public function getBookComments(Book $book, int $perPage = 10)
    {
        return $book->comments()->with('user')->paginate($perPage);
    }

    /**
     * Get comments for a specific category
     */
    public function getCategoryComments(Category $category, int $perPage = 10)
    {
        return $category->comments()->with('user')->paginate($perPage);
    }

    /**
     * Get books that have comments
     */
    public function getBooksWithComments(int $perPage = 15)
    {
        return Book::whereHas('comments', function ($query) {
            // This filters books that have at least one comment
        })->with('comments.user')->paginate($perPage);
    }

    /**
     * Get categories that have comments
     */
    public function getCategoriesWithComments(int $perPage = 15)
    {
        return Category::whereHas('comments', function ($query) {
            // This filters categories that have at least one comment
        })->with('comments.user')->paginate($perPage);
    }

    /**
     * Search comments by category name or book title
     */
    public function searchCommentsByTitle(string $search, int $page = 1, int $perPage = 10)
    {
        $comments = collect();

        // Search on both Category and Book using whereHasMorph
        $allComments = Comment::whereHasMorph(
            'commentable',
            [Category::class, Book::class],
            function ($query, $type) use ($search) {
                if ($type === Category::class) {
                    $query->where('name', 'like', '%' . $search . '%');
                } else if ($type === Book::class) {
                    $query->where('title', 'like', '%' . $search . '%');
                }
            }
        )->with('user', 'commentable')->get();

        $comments = $comments->merge($allComments);

        // Remove duplicates
        $comments = $comments->unique('id')->values();

        // Create paginated result
        $paginated = new Paginator(
            $comments->forPage($page, $perPage)->values(),
            $perPage,
            $page,
            [
                'path' => route('comments.search'),
                'query' => request()->query(),
            ]
        );

        return $paginated;
    }
}
