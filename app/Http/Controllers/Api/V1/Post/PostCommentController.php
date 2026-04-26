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
        // $totalComments = $post->comments()->count();
        $totalComments = PostComment::where('post_id', $post->id)
            ->whereNull('parent_id')
            ->count();
        
        $comments = PostComment::where('post_id', $post->id)
            ->with(['account.user', 'account.doctor', 'replies.account.user', 'replies.account.doctor'])
            ->latest()
            ->cursorPaginate(5)
            ->through(function ($comment) {
                // Get the appropriate name based on account role
                $displayName = 'Anonymous';
                if ($comment->account->role === 'user' && $comment->account->user) {
                    if ($comment->account->user->anonymous === 1){
                        $displayName = 'Anonymous';
                    } else {
                        $displayName = $comment->account->user->nickname;
                    }
                } elseif ($comment->account->role === 'doctor' && $comment->account->doctor) {
                    $displayName = $comment->account->doctor->name;
                }

                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'parent_id' => $comment->parent_id,
                    'account_id' => $comment->account_id,
                    'author' => [
                        'id' => $comment->account_id,
                        'name' => $displayName,
                        'role' => $comment->account->role,
                    ],
                    'created_at' => $comment->created_at,
                    'updated_at' => $comment->updated_at,
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
            'parent_id' => 'nullable|exists:post_comments,id',
        ]);

        $comment = PostComment::create([
            'post_id'    => $post->id,
            'account_id' => $request->user()->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'comment' => $validated['comment'],
        ]);

        $comment->load(['account.user', 'account.doctor']);

        $displayName = 'Anonymous';
        if ($comment->account->role === 'user' && $comment->account->user) {
            if ($comment->account->user->anonymous === 1) {
                $displayName = 'Anonymous';
            } else {
                $displayName = $comment->account->user->nickname;
            }
        } elseif ($comment->account->role === 'doctor' && $comment->account->doctor) {
            $displayName = $comment->account->doctor->name;
        }

        return response()->json([
            'message' => 'Comment created successfully',
            'status' => 'success',
            'data' => [
                'comment' => $comment,
                'account_id' => $comment->account_id,
                'author' => [
                    'id' => $comment->account_id,
                    'name' => $displayName,
                    'role' => $comment->account->role,
                ],
            ]
        ], 201);
    }

    public function update(Request $request, PostComment $comment)
    {
        if ($comment->account_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment->update($validated);
        $comment->load(['account.user', 'account.doctor']);

        return response()->json([
            'message' => 'Comment updated successfully',
            'status' => true,
            'data' => [
                'id' => $comment->id,
                'account_id' => $comment->account_id,
                'comment' => $comment->comment,
                'parent_id' => $comment->parent_id,
                'author' => [
                    'id' => $comment->account_id,
                    'name' => $this->resolveDisplayName($comment),
                    'role' => $comment->account->role,
                ],
                'updated_at' => $comment->updated_at,
            ],
        ], 200);
    }

    public function destroy(Request $request, PostComment $comment)
    {
        if ($comment->account_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $comment->load(['account.user', 'account.doctor']);

        $data = [
            'id' => $comment->id,
            'comment' => $comment->comment,
            'parent_id' => $comment->parent_id,
            'author' => [
                'name' => $this->resolveDisplayName($comment),
                'role' => $comment->account->role,
            ],
            'created_at' => $comment->created_at,
        ];

        $comment->delete();

        // Include account_id and author details for frontend ownership checks
        $data = array_merge($data, [
            'account_id' => $comment->account_id,
            'author' => [
                'id' => $comment->account_id,
                'name' => $this->resolveDisplayName($comment),
                'role' => $comment->account->role,
            ],
        ]);

        return response()->json([
            'message' => 'Comment deleted successfully',
            'status' => true,
            'data' => $data,
        ], 200);
    }

    private function resolveDisplayName(PostComment $comment): string
    {
        if ($comment->account->role === 'user' && $comment->account->user) {
            return $comment->account->user->anonymous ? 'Anonymous' : $comment->account->user->nickname;
        }

        if ($comment->account->role === 'doctor' && $comment->account->doctor) {
            return $comment->account->doctor->name;
        }

        return 'Anonymous';
    }
}
