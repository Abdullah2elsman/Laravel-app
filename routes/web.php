<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts', function () {
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

});



Route::get('/posts/create', function () {
    return view('posts.create');
});

Route::post('posts/create', function (Request $request) {
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
});

Route::get('/posts/{id}', function ($id) {
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
});

Route::get('/clear', function () {
    Session::forget('user_posts');
    return "Sessions Cleared!";
});