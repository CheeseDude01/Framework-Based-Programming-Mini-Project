<div class="max-w-lg mx-auto mt-10 p-6 bg-gray">
    <h2 class="text-2xl font-bold mb-6 text-center">➕ Add a New Manga</h2>

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Author</label>
            <input type="text" wire:model="author" class="w-full border rounded p-2">
            @error('author') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Genre</label>
            <input type="text" wire:model="genre" class="w-full border rounded p-2">
            @error('genre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Synopsis</label>
            <textarea wire:model="synopsis" class="w-full border rounded p-2" rows="5"></textarea>
            @error('synopsis') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Save Manga
        </button>
    </form>

    @if (session()->has('success'))
        <p class="mt-4 text-green-500 text-center font-medium">{{ session('success') }}</p>
    @endif
</div>
