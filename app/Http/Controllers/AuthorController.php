<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index()
    {
        $authors = Author::with('posts')->get();
        return response()->json(['messsage: ' => 'Done successfully', 'data' => AuthorResource::collection($authors)]);
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(AuthorStoreRequest $request)
    {

        $author = Author::create($request->all());

        return response()->json(['message: ' => 'author added successfully','data' => new AuthorResource($author)]);
    }

    /**
     * Display the specified author.
     */
    public function show(Author $author)
    {
        return response()->json(['data' => new AuthorResource($author)]);
    }

    /**
     * Update the specified author in storage.
     */
    public function update(AuthorStoreRequest $request, Author $author)
    {
        $validated = $request->validated();

        $author->update($validated);

        return response()->json(['message: ' => 'author updated successfully','data' => new AuthorResource($author)]);
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
