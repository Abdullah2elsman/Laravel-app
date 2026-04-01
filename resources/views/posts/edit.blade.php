<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased p-10">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Edit Post</h1>
        </div>
        <form method="POST" action="{{ url('/posts/' . $post['id']) }}"
            class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-xl" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $post['title']) }}"
                    class="w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-700">Image URL</label>
                <input type="text" name="image" value="{{ old('image', $post['image']) }}"
                    class="w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-700">Description</label>
                <textarea name="desc" rows="4"
                    class="w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600" required>{{ old('desc', $post['desc'] ?? ($post['content'] ?? '')) }}</textarea>
            </div>
            <div class="flex justify-end gap-4">
                <a href="/posts"
                    class="px-6 py-2 rounded-xl bg-gray-400 text-white font-bold uppercase shadow hover:bg-gray-500">Cancel</a>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-blue-600 text-white font-bold uppercase shadow hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</body>

</html>
