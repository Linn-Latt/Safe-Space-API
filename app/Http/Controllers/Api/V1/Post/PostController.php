<?php

namespace App\Http\Controllers\Api\V1\Post;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Get total count of posts
        $totalPosts = Post::where('status', 'published')->count();

        $posts = Post::with(['account.user', 'account.doctor'])
            ->where('status', 'published')
            ->latest()
            ->cursorPaginate(10)
            ->through(function ($post) {
                // Get author name based on role
                $authorName = 'Anonymous';
                if ($post->account->role === 'user' && $post->account->user) {
                    $authorName = $post->account->user->nickname;
                } elseif ($post->account->role === 'doctor' && $post->account->doctor) {
                    $authorName = $post->account->doctor->name;
                }

                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'author' => [
                        'name' => $authorName,
                        'role' => $post->account->role,
                    ],
                    'created_at' => $post->created_at,
                ];
            });

        return response()->json([
            'message' => 'Posts retrieved successfully',
            'status' => true,
            'data' => [
                'posts' => $posts->items(),
                'pagination' => [
                    'total' => $totalPosts,
                    'limit' => $posts->perPage(),
                    'next_cursor' => $posts->nextCursor()?->encode(),
                    'prev_cursor' => $posts->previousCursor()?->encode(),
                ],
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $account = $request->user();
        if ($account->role !== 'doctor') {
            return response()->json([
                'message' => 'Only doctors can create posts.'
            ], 403); 
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'account_id' => $account->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'status' => true,
            'data' => $post,
        ], 201);
    }

    public function update(Post $post, Request $request)
    {
        $account = $request->user();
        if ($account->role !== 'doctor' || $post->account_id !== $account->id) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Post updated successfully',
            'status' => true,
            'data' => $post,
        ], 200);
    }

    public function destory(Post $post, Request $request)
    {
        $account = $request->user();
        if ($account->role !== 'doctor' || $post->account_id !== $account->id) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
            'status' => 'success',
        ], 200);
    }
}
