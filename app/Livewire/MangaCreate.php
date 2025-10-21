<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;

class MangaCreate extends Component
{
    public $title = '';
    public $author = '';
    public $genre = '';
    public $synopsis = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'author' => 'nullable|string|max:255',
        'genre' => 'nullable|string|max:255',
        'synopsis' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        Manga::create([
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'synopsis' => $this->synopsis,
            'created_by' => Auth::id(),
        ]);

        session()->flash('success', 'Manga added successfully!');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.mangacreate');
    }
}
