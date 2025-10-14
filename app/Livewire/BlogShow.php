<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;

class BlogShow extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = BlogPost::published()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function render()
    {
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $this->post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('livewire.blog-show', [
            'relatedPosts' => $relatedPosts,
        ])->layout('layouts.app', ['title' => $this->post->title . ' - Mutesilinda']);
    }
}
