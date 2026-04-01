<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased p-10">

    <div class="hidden bg-blue-600 bg-emerald-600 bg-purple-600 bg-gray-800"></div>

    <div class="container mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Recent Posts</h1>

            <a href="/posts/create"
                class="flex items-center gap-2 rounded-xl bg-blue-600 py-3 px-6 text-sm font-bold uppercase text-white shadow-lg shadow-blue-500/30 transition-all hover:scale-105 hover:bg-blue-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create New Post
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 justify-items-center">
            @foreach ($posts as $post)
                <div
                    class="relative flex w-full max-w-[22rem] flex-col rounded-2xl bg-white shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <div class="relative mx-4 -mt-6 h-48 overflow-hidden rounded-2xl shadow-lg group">
                        <img src="{{ $post['image'] }}"
                            onerror="this.src='https://images.unsplash.com/photo-1432821596592-e2c18b78144f?w=800'"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    </div>

                    <div class="p-6 text-left">
                        <h5 class="mb-3 block text-xl font-bold text-gray-900 lowercase">
                            {{ $post['title'] }}
                        </h5>
                        <p class="text-sm font-normal text-gray-600 leading-relaxed">
                            {{ Str::limit($post['desc'], 100) }} </p>
                    </div>

                    <div class="p-6 pt-0">
                        <div class="flex flex-col gap-2">
                            <a href="/posts/{{ $post['id'] }}"
                                class="inline-block w-full text-center rounded-xl {{ $post['color'] ?? 'bg-gray-800' }} py-3 text-sm font-bold uppercase text-white shadow-lg transition-all hover:scale-[1.02] mb-2">
                                Read more
                            </a>
                            <div class="flex gap-2">
                                <a href="/posts/{{ $post['id'] }}/edit"
                                    class="flex-1 text-center rounded-xl bg-emerald-600 py-2 text-sm font-bold uppercase text-white shadow hover:bg-emerald-700 transition-all">
                                    Edit
                                </a>
                                <form action="/posts/{{ $post['id'] }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this post?');"
                                        class="w-full rounded-xl bg-red-600 py-2 text-sm font-bold uppercase text-white shadow hover:bg-red-700 transition-all">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
