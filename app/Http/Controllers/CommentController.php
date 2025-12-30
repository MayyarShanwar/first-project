<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    /**
     * Display a listing of the comments.
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json(['messsage: ' => 'Done successfully', 'data' => CommentResource::collection($comments)]);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(CommentStoreRequest $request)
    {
        $comment = Comment::create($request->all());

        return response()->json(['message: ' => 'comment added successfully','data' => new CommentResource($comment)]);
    }

    /**
     * Display the specified comment.
     */
    public function show(Comment $comment)
    {
        return response()->json(['data' => new CommentResource($comment)]);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(CommentStoreRequest $request, Comment $comment)
    {
        $validated = $request->validated();

        $comment->update($validated);

        return response()->json(['message: ' => 'comment updated successfully','data' => new CommentResource($comment)]);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'comment deleted successfully']);
    }
}
