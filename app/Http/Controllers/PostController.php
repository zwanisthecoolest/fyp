<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id); 
 
        return view('layouts.post', compact('post'));
    }

    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $editingPost = null;

        if (request('edit')) {
            $editingPost = Post::findOrFail(request('edit'));
        }

        return view('layouts.posts', compact('posts', 'categories', 'editingPost'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'image' => ['nullable', 'url', 'max:500'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        Post::create($validated);

        return redirect()->route('posts.manage')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        $oldId = $post->id;
        $newId = $request->input('id');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'image' => ['nullable', 'url', 'max:500'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'id' => ['required', 'integer', 'unique:posts,id,' . $oldId],
        ]);

        if ($oldId != $newId) {
            DB::table('posts')
                ->where('id', $oldId)
                ->update([
                    'id' => $newId,
                    'title' => $validated['title'],
                    'text' => $validated['text'],
                    'image' => $validated['image'],
                    'category_id' => $validated['category_id'],
                ]);
        } else {
            $post->update([
                'title' => $validated['title'],
                'text' => $validated['text'],
                'image' => $validated['image'],
                'category_id' => $validated['category_id'],
            ]);
        }

        return redirect()->route('posts.manage')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.manage')->with('success', 'Post deleted successfully!');
    }
}
