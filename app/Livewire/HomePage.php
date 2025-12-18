<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;
use App\Models\Book;
use App\Models\Podcast;
use App\Models\HeroSection;
use App\Models\QuickLink;
use App\Models\Affiliation;
use Illuminate\Support\Facades\Schema;

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

        $featuredBook = null;
        $featuredPodcast = null;

        if (Schema::hasTable('books')) {
            $featuredBook = Book::query()
                ->active()
                ->orderByDesc('is_featured')
                ->latest('published_at')
                ->latest('created_at')
                ->first();
        }

        if (Schema::hasTable('podcasts')) {
            $featuredPodcast = Podcast::query()
                ->active()
                ->orderByDesc('is_featured')
                ->latest('listened_at')
                ->latest('created_at')
                ->first();
        }

        return view('livewire.home-page', [
            'heroSection' => $heroSection,
            'quickLinks' => $quickLinks,
            'affiliations' => $affiliations,
            'featuredPost' => $featuredPost,
            'recentPosts' => $recentPosts,
            'featuredBook' => $featuredBook,
            'featuredPodcast' => $featuredPodcast,
        ])->layout('layouts.app', ['title' => 'Home - Mutesilinda']);
    }
}
