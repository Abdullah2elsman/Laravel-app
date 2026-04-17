<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

    public function store(StorePostRequest $request)
    {

        $data = $request->except('image');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

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
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        $post = Post::findOrFail($id);

        $data = $validated;
        unset($data['image']);

        if ($request->hasFile('image'))
        {
            if ($post->image && Storage::disk('public')->exists($post->image))
            {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image && Storage::disk('public')->exists($post->image))
        {
            Storage::disk('public')->delete($post->image);
            $post->image = null;
        }
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
