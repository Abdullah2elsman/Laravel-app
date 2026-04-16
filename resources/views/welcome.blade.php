<!DOCTYPE html>
<html lang="ar" dir="rtl">
@vite(['resources/css/app.css', 'resources/js/app.js'])

<head>
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">

            <div class="text-2xl font-bold text-blue-600">
                <a href="#">Logo</a>
            </div>

            <div class="hidden md:flex space-x-8 space-x-reverse">
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                <a href="/posts" class="text-gray-600 hover:text-blue-600 transition">Posts</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">About<a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">Contact Us</a>
            </div>

            

            <div class="md:hidden">
                <button class="text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

        </nav>
    </header>
    </body>

</html>
