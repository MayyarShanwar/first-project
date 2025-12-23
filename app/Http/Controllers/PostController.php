<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
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
    public function store(PostStoreRequest $request)
    {

        Post::create($request->all());

        return response()->json(['message: ' => 'post added successfully']);
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        return response()->json(['post' => $post]);
    }

    /**
     * Update the specified post in storage.
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        return response()->json(['message: ' => 'post updated successfully']);
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['messsage' => 'Post deleted successfully']);
    }
}
