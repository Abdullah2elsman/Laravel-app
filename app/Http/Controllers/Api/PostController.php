<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function showPosts()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function showPost($id)
    {
        $post = Post::find($id);

        return new PostResource($post);
    }

    public function storePost(StorePostRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        return new PostResource($post);
    }

    public function sanctumLogin(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The data is wrong.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
