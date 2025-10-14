<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class ResearchInterestsPage extends Component
{
    public function render()
    {
        $page = Page::published()->where('slug', 'research-interests')->first();

        return view('livewire.research-interests-page', [
            'page' => $page,
        ])->layout('layouts.app', ['title' => 'Research Interests - Linda Mutesi']);
    }
}
