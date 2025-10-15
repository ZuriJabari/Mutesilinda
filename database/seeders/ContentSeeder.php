<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\MenuItem;
use App\Models\QuickLink;
use App\Models\Affiliation;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero Section
        HeroSection::create([
            'greeting' => 'Hello, I\'m',
            'name' => 'Linda Mutesi!',
            'description' => 'I work with artists, entrepreneurs, and civic leaders to grow opportunity across Uganda and beyond — nurturing creativity, championing women‑ and youth‑led enterprises, and advancing African philanthropy. This blog is where I bring these journeys together — reflections, behind‑the‑scenes insights, and conversations with fellow creatives. I invite you to join me on this journey.',
            'image_path' => '/images/linda-hero.png',
            'is_active' => true,
            'order' => 1,
        ]);

        // Menu Items
        $menuItems = [
            ['label' => 'Home', 'url' => '/', 'order' => 1],
            ['label' => 'About', 'url' => '/about', 'order' => 2],
            ['label' => 'Affiliations', 'url' => '#', 'has_dropdown' => true, 'order' => 3],
            ['label' => 'Thinking About', 'url' => '/blog', 'order' => 4],
            ['label' => 'Research Interests', 'url' => '/research-interests', 'order' => 5],
            ['label' => 'Get in Touch', 'url' => '/contact', 'order' => 6],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }

        // Quick Links
        $quickLinks = [
            [
                'label' => 'Affiliations',
                'title' => 'Organizations I Work With',
                'url' => '#affiliations',
                'bg_color' => '#F3EEE9',
                'order' => 1,
            ],
            [
                'label' => 'Thinking About',
                'title' => 'Reflections & Insights',
                'url' => '/blog',
                'bg_color' => '#EDE8F0',
                'order' => 2,
            ],
            [
                'label' => 'Research',
                'title' => 'Research Interests',
                'url' => '/research-interests',
                'bg_color' => '#E7EFEA',
                'order' => 3,
            ],
            [
                'label' => 'Get in Touch',
                'title' => 'Let\'s Connect',
                'url' => '#contact',
                'bg_color' => '#F3EEE9',
                'order' => 4,
            ],
        ];

        foreach ($quickLinks as $link) {
            QuickLink::create($link);
        }

        // Affiliations
        $affiliations = [
            ['name' => 'Adalci Advocates', 'url' => 'https://adalci.co.ug/our-team/', 'order' => 1],
            ['name' => 'FG Foundation', 'url' => 'https://fgfoundation.africa', 'order' => 2],
            ['name' => 'Bold Woman Fund', 'url' => 'https://www.theboldwomanfund.com/thefounders', 'order' => 3],
            ['name' => 'Bold in Africa', 'url' => 'https://www.boldinafrica.com/aboutus', 'order' => 4],
            ['name' => 'The Citizen Report–Uganda', 'url' => 'https://thecitizenreport.ug', 'order' => 5],
            ['name' => '32 Degrees East', 'url' => 'https://32east.org', 'order' => 6],
        ];

        foreach ($affiliations as $affiliation) {
            Affiliation::create($affiliation);
        }
    }
}
