<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the comments.
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json(['messsage: ' => 'Done successfully', 'comments' => $comments]);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $comment = $request->validate([
            'content' => ['required'],
            'post_id' => ['required'],
        ]);

        Comment::create($comment);

        return response()->json(['message: ' => 'comment added successfully']);
    }

    /**
     * Display the specified comment.
     */
    public function show(Comment $comment)
    {
        $comment = Comment::find($comment->id);
        return response()->json(['comment' => $comment]);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => ['required', 'min:3'],
            'post_id' => ['required']
        ]);

        $comment = Comment::find($comment->id);

        $comment->update([
            'content' => $request->content,
            'post_id' => $request->post_id,
        ]);

        return response()->json(['message: ' => 'comment updated successfully']);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        Comment::find($comment->id)->delete();
        return response()->json(['message' => 'comment deleted successfully']);
    }
}
