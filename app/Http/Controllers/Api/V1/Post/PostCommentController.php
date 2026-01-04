<?php

namespace App\Http\Controllers\Api\V1\Post;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index(Post $post)
    {
        $totalComments = $post->comments()->count();
        
        $comments = PostComment::where('post_id', $post->id)
            ->with(['account.user', 'account.doctor'])
            ->latest()
            ->cursorPaginate(5)
            ->through(function ($comment) {
                // Get the appropriate name based on account role
                $displayName = 'Anonymous';
                if ($comment->account->role === 'user' && $comment->account->user) {
                    $displayName = $comment->account->user->nickname;
                } elseif ($comment->account->role === 'doctor' && $comment->account->doctor) {
                    $displayName = $comment->account->doctor->name;
                }

                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'author' => [
                        'name' => $displayName,
                        'role' => $comment->account->role,
                    ],
                    'created_at' => $comment->created_at,
                ];
            });

        return response()->json([
            'message' => 'Comments retrieved successfully',
            'status' => true,
            'data' => [
                'comments' => $comments->items(),
                'pagination' => [
                    'total' => $totalComments,
                    'limit' => $comments->perPage(),
                    'next_cursor' => $comments->nextCursor()?->encode(),
                    'prev_cursor' => $comments->previousCursor()?->encode(),
                ],
            ],
        ], 200);
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = PostComment::create([
            'post_id'    => $post->id,
            'account_id' => $request->user()->id,
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'message' => 'Comment created successfully',
            'status' => 'success',
            'data' => $comment,
        ], 201);
    }
}
