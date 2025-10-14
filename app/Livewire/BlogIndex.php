<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BlogPost;

class BlogIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = BlogPost::published()
            ->latest('published_at')
            ->paginate(9);

        return view('livewire.blog-index', [
            'posts' => $posts,
        ])->layout('layouts.app', ['title' => 'Thinking About - Blog']);
    }
}
