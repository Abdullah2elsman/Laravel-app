<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'UI/UX Design Review',
                'image' => 'https://images.unsplash.com/photo-1540553016722-983e48a2cd10?w=800',
                'desc' => 'Experience the best design trends in Barcelona, located right next to the beach and city center.',
                'color' => 'bg-blue-600'
            ],
            [
                'id' => 2,
                'title' => 'Web App Development',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800',
                'desc' => 'Learn how to build high-performance web applications using Laravel and Tailwind CSS.',
                'color' => 'bg-emerald-600'
            ],
            [
                'id' => 3,
                'title' => 'Artificial Intelligence',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800',
                'desc' => 'Exploring the future of programming and automation with the latest AI technologies.',
                'color' => 'bg-purple-600'
            ]
        ];
        $userPosts = Session::get('user_posts', []);

        $posts = array_merge($posts, $userPosts);

        return view('posts.posts', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $newPost = [
            'id' => time(),
            'title' => $request->title,
            'image' => $request->image ?: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800',
            'desc' => $request->desc,
            'color' => 'bg-blue-600'
        ];

        $userPosts = Session::get('user_posts', []);
        $userPosts[] = $newPost;
        Session::put('user_posts', $userPosts);

        return redirect('/posts');
    }

    public function show($id)
    {
        $posts = [
            1 => ['title' => 'UI/UX Design Review', 'image' => 'https://images.unsplash.com/photo-1540553016722-983e48a2cd10?w=1200', 'content' => 'Full details about UI/UX... This is a much longer text to show in the single page.'],
            2 => ['title' => 'Web App Development', 'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200', 'content' => 'Full details about Web Dev...'],
            3 => ['title' => 'Artificial Intelligence', 'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=1200', 'content' => 'Full details about AI...']
        ];
        $userPosts = Session::get('user_posts', []);

        $formattedUserPosts = [];
        foreach ($userPosts as $p) {
            $formattedUserPosts[$p['id']] = [
                'title' => $p['title'],
                'image' => $p['image'],
                'content' => $p['desc']
            ];
        }

        $posts = $posts + $formattedUserPosts;

        if (!isset($posts[$id])) {
            abort(404);
        }

        $post = $posts[$id];
        return view('posts.post', ['post' => $post]);
    }


    public function edit($id)
    {
        $posts = [
            1 => [
                'id' => 1,
                'title' => 'UI/UX Design Review',
                'image' => 'https://images.unsplash.com/photo-1540553016722-983e48a2cd10?w=1200',
                'desc' => 'Experience the best design trends in Barcelona, located right next to the beach and city center.',
                'color' => 'bg-blue-600',
            ],
            2 => [
                'id' => 2,
                'title' => 'Web App Development',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200',
                'desc' => 'Learn how to build high-performance web applications using Laravel and Tailwind CSS.',
                'color' => 'bg-emerald-600',
            ],
            3 => [
                'id' => 3,
                'title' => 'Artificial Intelligence',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=1200',
                'desc' => 'Exploring the future of programming and automation with the latest AI technologies.',
                'color' => 'bg-purple-600',
            ],
        ];
        $userPosts = Session::get('user_posts', []);
        foreach ($userPosts as $p) {
            $posts[$p['id']] = $p;
        }
        if (!isset($posts[$id])) {
            abort(404);
        }
        $post = $posts[$id];
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $userPosts = Session::get('user_posts', []);
        $found = false;
        foreach ($userPosts as $i => $post) {
            if ($post['id'] == $id) {
                $userPosts[$i]['title'] = $request->title;
                $userPosts[$i]['image'] = $request->image ?: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800';
                $userPosts[$i]['desc'] = $request->desc;
                $found = true;
                break;
            }
        }
        if ($found) {
            Session::put('user_posts', $userPosts);
        }
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $oldPosts = Session::get('user_posts', []);

        $newPosts = [];

        foreach ($oldPosts as $post) {
            if ($post['id'] != $id) {
                $newPosts[] = $post;
            }
        }

        Session::put('user_posts', $newPosts);

        return redirect('/posts');
    }
}
