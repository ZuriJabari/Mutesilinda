<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class TermsPage extends Component
{
    public function render()
    {
        $page = Page::published()->where('slug', 'terms')->first();

        return view('livewire.terms-page', [
            'page' => $page,
        ])->layout('layouts.app', ['title' => 'Terms of Service - Linda Mutesi']);
    }
}
