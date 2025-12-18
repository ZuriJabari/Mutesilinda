<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class PrivacyPage extends Component
{
    public function render()
    {
        $page = Page::published()->where('slug', 'privacy')->first();

        return view('livewire.privacy-page', [
            'page' => $page,
        ])->layout('layouts.app', ['title' => 'Privacy Policy - Linda Mutesi']);
    }
}
