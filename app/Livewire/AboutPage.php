<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class AboutPage extends Component
{
    public function render()
    {
        $page = Page::published()->where('slug', 'about')->first();

        return view('livewire.about-page', [
            'page' => $page,
        ])->layout('layouts.app', ['title' => 'About - Linda Mutesi']);
    }
}
