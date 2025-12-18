<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\BlogIndex;
use App\Livewire\BlogShow;
use App\Livewire\AboutPage;
use App\Livewire\PrivacyPage;
use App\Livewire\TermsPage;
use App\Livewire\ResearchInterestsPage;
use App\Livewire\LibraryPage;
use Illuminate\Http\Request;

Route::get('/', HomePage::class)->name('home');
Route::get('/blog', BlogIndex::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/privacy', PrivacyPage::class)->name('privacy');
Route::get('/terms', TermsPage::class)->name('terms');
Route::get('/contact', function (Request $request) {
    $previous = url()->previous();

    if (!is_string($previous) || $previous === '' || str_contains($previous, '/contact')) {
        $previous = route('home', absolute: false);
    }

    $separator = str_contains($previous, '?') ? '&' : '?';

    return redirect()->to($previous.$separator.'contact=1');
})->name('contact');
Route::get('/research-interests', ResearchInterestsPage::class)->name('research-interests');

Route::get('/library', LibraryPage::class)->name('library');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
