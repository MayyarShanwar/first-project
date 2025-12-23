<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index()
    {
        $authors = Author::with('posts')->get();
        return response()->json(['messsage: ' => 'Done successfully', 'authors' => $authors]);
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(Request $request)
    {
        $author = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email']
        ]);

        Author::create($author);

        return response()->json(['message: ' => 'author added successfully']);
    }

    /**
     * Display the specified author.
     */
    public function show(Author $author)
    {
        return response()->json(['author' => $author]);
    }

    /**
     * Update the specified author in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email']
        ]);

        $author->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['message: ' => 'author updated successfully']);
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(['message' => 'author deleted successfully']);
    }
}
