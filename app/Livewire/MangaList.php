<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Manga;

class MangaList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $mangas = Manga::withCount('reviews')
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(12);

        return view('livewire.mangalist', [
            'mangas' => $mangas,
        ]);
    }
}
