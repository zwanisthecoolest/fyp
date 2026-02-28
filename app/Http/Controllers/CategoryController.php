<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $editingCategory = null;

        if (request('edit')) {
            $editingCategory = Category::findOrFail(request('edit'));
        }

        $posts = Post::all();

        return view('layouts.categories', compact('categories', 'posts', 'editingCategory'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,NULL,id,deleted_at,NULL'],
        ]);

        $trashedCategory = Category::onlyTrashed()
            ->where('name', $validated['name'])
            ->first();

        if ($trashedCategory) {
            $trashedCategory->restore();

            return redirect()->route('categories')->with('success', 'Category restored successfully!');
        }

        Category::create($validated);

        return redirect()->route('categories')->with('success', 'Category created successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $oldId = $category->id;
        $newId = $request->input('id');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $oldId],
            'id' => ['required', 'integer', 'unique:categories,id,' . $oldId],
        ]);

        if ($oldId != $newId) {
            DB::table('categories')
                ->where('id', $oldId)
                ->update([
                    'id' => $newId,
                    'name' => $validated['name'],
                ]);
        } else {
            // Just update the name if ID hasn't changed
            $category->update(['name' => $validated['name']]);
        }

        return redirect()->route('categories')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if (strtolower($category->name) === 'miscellaneous') {
            return redirect()->route('categories')->with('error', 'The Miscellaneous category cannot be deleted.');
        }

        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully!');
    }

    public function updatePostCategory(Request $request, Post $post)
    {
        $validated = $request->validate([
            'new_category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
        ]);

        $post->update([
            'category_id' => (int) $validated['new_category_id'],
        ]);

        return redirect()->route('categories')->with('success', 'Post category updated successfully!');
    }
}
