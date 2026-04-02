<form action="/posts/{{ $post->id }}/restore" method="POST">
    @csrf
    @method('PATCH')
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">
        Restore Post
    </button>
</form>