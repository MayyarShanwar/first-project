<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with('comments')->get();
        return response()->json(['messsage: ' => 'Done successfully', 'posts' => $posts]);
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $post = $request->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required'],
            'author_id' => ['required'],
            'category_id' => ['required'],
        ]);

        Post::create($post);

        return response()->json(['message: ' => 'post added successfully']);
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post = Post::find($post->id);
        return response()->json(['post' => $post]);
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required'],
            'author_id' => ['required'],
            'category_id' => ['required'],
        ]);

        $post = Post::find($post->id);

        $post->update([
            'name' => $request->name,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message: ' => 'post updated successfully']);
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        Post::find($post->id)->delete();
        return response()->json(['messsage' => 'Post deleted successfully']);
    }
}
