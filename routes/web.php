<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\BlogIndex;
use App\Livewire\BlogShow;
use App\Livewire\AboutPage;
use App\Livewire\ContactPage;
use App\Livewire\ResearchInterestsPage;

Route::get('/', HomePage::class)->name('home');
Route::get('/blog', BlogIndex::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/research-interests', ResearchInterestsPage::class)->name('research-interests');
