<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Prompts\Output\ConsoleOutput;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::with('posts')->get();
        return response()->json(['messsage: ' => 'Done successfully', 'categories' => $categories]);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $category = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        Category::create($category);

        return response()->json(['message: ' => 'category added successfully']);

    }

    /**
     * Display the specified category.
     */
    public function show(Request $request)
    {
        $category = Category::find(request('category'));
        return response()->json(['category' => $category]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'min:3']
        ]);

        $category = Category::find(request('category'));

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(['message: ' => 'category updated successfully']);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        Category::find(request('category'))->delete();
        return response(200);
    }
}
