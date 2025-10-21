<div class="max-w-3xl mx-auto mt-10 p-6 bg-zinc-900 text-white rounded-xl shadow-lg">
    <h1 class="text-3xl font-bold mb-2">{{ $manga->title }}</h1>
    <p class="mb-1"><strong>Author:</strong> {{ $manga->author }}</p>
    <p class="mb-1"><strong>Genre:</strong> {{ $manga->genre }}</p>
    <p class="mb-3"><strong>Synopsis:</strong> {{ $manga->synopsis }}</p>

    <hr class="my-6 border-zinc-700">

    <h2 class="text-2xl font-semibold mb-4">Reviews</h2>

    @forelse ($manga->reviews as $review)
        <div class="border border-zinc-700 p-4 rounded-lg mb-4 bg-zinc-800">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-yellow-400 font-bold">Rating: {{ $review->rating }}/10</p>
                    <p class="mt-1">{{ $review->review }}</p>
                    <p class="text-sm text-zinc-400 mt-2">
                        by {{ $review->user->name }} • {{ $review->created_at->diffForHumans() }}
                    </p>
                </div>

                @auth
                    @if (Auth::id() === $review->user_id)
                        <div class="flex gap-2 ml-4">
                            <button wire:click="editReview({{ $review->id }})"
                                class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 rounded transition">
                                Edit
                            </button>
                            <button wire:click="deleteReview({{ $review->id }})"
                                class="px-3 py-1 text-sm bg-red-600 hover:bg-red-700 rounded transition"
                                onclick="return confirm('Are you sure you want to delete this review?')">
                                Delete
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    @empty
        <p class="text-zinc-400">No reviews yet. Be the first to review!</p>
    @endforelse

    {{-- Add Review --}}
    @auth
        <hr class="my-6 border-zinc-700">

        @if (!$editingReviewId)
            <h3 class="text-xl font-semibold mb-3">Add Your Review</h3>

            <form wire:submit.prevent="addReview" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Rating (1–10)</label>
                    <input type="number" wire:model="rating" min="1" max="10"
                           class="w-full border border-zinc-600 bg-zinc-800 rounded p-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('rating')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Review</label>
                    <textarea wire:model="reviewText" rows="4"
                              class="w-full border border-zinc-600 bg-zinc-800 rounded p-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('reviewText')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Submit Review
                </button>
            </form>
        @endif

        @if ($editingReviewId)
            <h3 class="text-xl font-semibold mb-3 mt-6">Edit Your Review</h3>

            <form wire:submit.prevent="updateReview" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Rating (1–10)</label>
                    <input type="number" wire:model="rating" min="1" max="10"
                           class="w-full border border-zinc-600 bg-zinc-800 rounded p-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('rating')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Review</label>
                    <textarea wire:model="reviewText" rows="4"
                              class="w-full border border-zinc-600 bg-zinc-800 rounded p-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('reviewText')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Update Review
                    </button>
                    <button type="button" wire:click="cancelEdit"
                            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                        Cancel
                    </button>
                </div>
            </form>
        @endif

        @if (session()->has('message'))
            <p class="mt-4 text-green-400 font-medium">{{ session('message') }}</p>
        @endif
    @endauth
</div>
