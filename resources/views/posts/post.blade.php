<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="max-w-4xl mx-auto p-6">
        <a href="/posts" class="text-blue-600 hover:underline mb-6 inline-block">← Back to all posts</a>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <img src="{{ $post['image'] && str_starts_with($post['image'], 'http') ? $post['image'] : asset('storage/' . $post['image']) }}" class="w-full h-[400px] object-cover" alt="">
            
            <div class="p-10">
                <h1 class="text-4xl font-black text-gray-900 mb-6">{{ $post['title'] }}</h1>
                
                <div class="prose prose-lg text-gray-700 leading-relaxed">
                    <p class="mb-4">
                        {{ $post['content'] }}
                    </p>
                    <p>
                        Additional content goes here. Since we are using Tailwind, you can style this area beautifully! 
                        In a real project, this content would come from a database.
                    </p>
                </div>

                <div class="mt-10 pt-10 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-gray-500 text-sm">Published on: March 31, 2026</span>
                    <button class="bg-gray-900 text-white px-6 py-2 rounded-full text-sm">Share Post</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>