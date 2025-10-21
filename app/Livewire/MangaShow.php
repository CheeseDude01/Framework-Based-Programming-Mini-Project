<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Manga;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class MangaShow extends Component
{
    public $mangaId;
    public $manga;
    public $rating = null;
    public $reviewText = '';
    public $editingReviewId = null;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:10',
        'reviewText' => 'required|string|min:3',
    ];

    public function mount($id)
    {
        $this->mangaId = $id;
        $this->loadManga();
    }

    public function loadManga()
    {
        $this->manga = Manga::with(['reviews.user'])->findOrFail($this->mangaId);
    }

    public function addReview()
    {
        $this->validate();

        Review::create([
            'user_id' => Auth::id(),
            'manga_id' => $this->mangaId,
            'rating' => $this->rating,
            'review' => $this->reviewText,
        ]);

        session()->flash('message', 'Review submitted!');
        $this->reset(['rating', 'reviewText']);
        $this->loadManga();
    }

    public function editReview($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $this->editingReviewId = $id;
        $this->rating = $review->rating;
        $this->reviewText = $review->review;
    }

    public function updateReview()
    {
        $this->validate();

        $review = Review::findOrFail($this->editingReviewId);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->update([
            'rating' => $this->rating,
            'review' => $this->reviewText,
        ]);

        session()->flash('message', 'Review updated!');
        $this->cancelEdit();
        $this->loadManga();
    }

    public function cancelEdit()
    {
        $this->reset(['editingReviewId', 'rating', 'reviewText']);
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();
        session()->flash('message', 'Review deleted!');
        $this->loadManga();
    }

    public function render()
    {
        return view('livewire.mangashow', [
            'manga' => $this->manga,
        ]);
    }
}
