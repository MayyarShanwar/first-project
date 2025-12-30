<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Prompts\Output\ConsoleOutput;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::with('posts')->get();
        return response()->json(['messsage: ' => 'Done successfully', 'data' => CategoryResource::collection($categories)]);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryStoreRequest $request)
    {

        $category = Category::create($request->all());

        return response()->json(['message: ' => 'category added successfully', 'data' => new CategoryResource($category)]);

    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return response()->json(['data' => new CategoryResource($category)]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return response()->json(['message: ' => 'category updated successfully','data' => new CategoryResource($category)]);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
