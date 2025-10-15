<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;
use App\Models\HeroSection;
use App\Models\QuickLink;
use App\Models\Affiliation;

class HomePage extends Component
{
    public function render()
    {
        $heroSection = HeroSection::where('is_active', true)
            ->orderBy('order')
            ->first();

        $quickLinks = QuickLink::where('is_active', true)
            ->orderBy('order')
            ->get();

        $affiliations = Affiliation::where('is_active', true)
            ->orderBy('order')
            ->get();

        $featuredPost = BlogPost::published()
            ->latest('published_at')
            ->first();

        $recentPosts = BlogPost::published()
            ->latest('published_at')
            ->skip(1)
            ->take(3)
            ->get();

        return view('livewire.home-page', [
            'heroSection' => $heroSection,
            'quickLinks' => $quickLinks,
            'affiliations' => $affiliations,
            'featuredPost' => $featuredPost,
            'recentPosts' => $recentPosts,
        ])->layout('layouts.app', ['title' => 'Home - Mutesilinda']);
    }
}
