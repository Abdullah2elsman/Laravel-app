<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_deleted', 0)->latest()->paginate(10);
        return view('posts.posts', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => "unique|required|min:5",
            'image' => "nullable",
            'desc' => "required|min:10"
        ]);

        Post::create($validated);
        return redirect('/posts');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.post', ['post' => $post]);
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => "required|max:255",
            'desc' => "required",
            'image' => "nullable"
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->is_deleted = 1;
        $post->save();
        return redirect('/posts');
    }

    public function restore($id)
    {
        $post = Post::findOrFail($id);
        $post->is_deleted = 0; 
        $post->save();

        return redirect('/posts')->with('success', 'Post restored successfully!');
    }
}
