<div class="max-w-5xl mx-auto mt-10 p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Manga List</h1>

    <div class="flex justify-end mb-4">
        @auth
            <a href="{{ route('manga.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                + Add New Manga
            </a>
        @endauth
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($mangas as $manga)
            <div class="border rounded-lg shadow hover:shadow-lg transition p-4 bg-gray">
                <h2 class="text-xl font-semibold mb-2">{{ $manga->title }}</h2>
                <p class="text-white">Author: {{ $manga->author }}</p>
                <p class="text-white">Genre: {{ $manga->genre }}</p>
                <p class="text-white">{{ Str::limit($manga->synopsis, 100) }}</p>
                
                <a href="{{ route('manga.show', $manga->id) }}"
                   class="text-blue-600 hover:underline">Read Reviews →</a>
            </div>
        @endforeach
    </div>

    @if ($mangas->isEmpty())
        <p class="text-center text-gray-500 mt-10">No manga added yet.</p>
    @endif
</div>
