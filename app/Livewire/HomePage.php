<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;

class HomePage extends Component
{
    public function render()
    {
        $featuredPost = BlogPost::published()
            ->latest('published_at')
            ->first();

        $recentPosts = BlogPost::published()
            ->latest('published_at')
            ->skip(1)
            ->take(3)
            ->get();

        return view('livewire.home-page', [
            'featuredPost' => $featuredPost,
            'recentPosts' => $recentPosts,
        ])->layout('layouts.app', ['title' => 'Home - Mutesilinda']);
    }
}
