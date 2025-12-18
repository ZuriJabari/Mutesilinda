<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\LibraryActivityLog;
use App\Models\LibraryHold;
use App\Models\LibraryLoan;
use App\Models\Podcast;
use App\Models\BlogPost;
use App\Notifications\LibraryHoldCreated;
use App\Notifications\LibraryLoanRequested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class LibraryPage extends Component
{
    public $note = '';
    public $showBorrowModal = false;
    public $selectedBookId = null;

    public function openBorrowModal(int $bookId): void
    {
        if (!Auth::check()) {
            redirect()->route('login', ['redirect' => route('library', absolute: false)])->send();
            return;
        }

        $this->selectedBookId = $bookId;
        $this->note = '';
        $this->showBorrowModal = true;
    }

    public function closeBorrowModal(): void
    {
        $this->showBorrowModal = false;
        $this->selectedBookId = null;
        $this->note = '';
    }

    public function confirmBorrow(): void
    {
        if (!is_int($this->selectedBookId)) {
            $this->closeBorrowModal();
            return;
        }

        $this->requestBorrow($this->selectedBookId);
        $this->showBorrowModal = false;
        $this->selectedBookId = null;
    }

    public function requestBorrow(int $bookId)
    {
        if (!Schema::hasTable('books') || !Schema::hasTable('library_loans') || !Schema::hasTable('library_holds')) {
            session()->flash('library_status', 'Library setup is not complete yet. Please try again shortly.');
            return;
        }

        if (!Auth::check()) {
            return redirect()->route('login', ['redirect' => route('library', absolute: false)]);
        }

        $user = Auth::user();

        $book = Book::query()
            ->active()
            ->findOrFail($bookId);

        $activeLoanExists = LibraryLoan::query()
            ->where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['requested', 'approved', 'checked_out'])
            ->exists();

        if ($activeLoanExists) {
            session()->flash('library_status', 'You already have an active request for this book.');
            return;
        }

        $isUnavailable = LibraryLoan::query()
            ->where('book_id', $book->id)
            ->whereIn('status', ['approved', 'checked_out'])
            ->exists();

        if (!$isUnavailable) {
            $loan = LibraryLoan::create([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'status' => 'requested',
                'user_note' => trim($this->note) !== '' ? trim($this->note) : null,
                'requested_at' => now(),
            ]);

            LibraryActivityLog::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'action' => 'library.loan_requested',
                'meta' => [
                    'loan_id' => $loan->id,
                ],
            ]);

            $user->notify(new LibraryLoanRequested($loan));

            session()->flash('library_status', 'Request sent. You will receive an email once it’s approved.');

            $this->note = '';

            return;
        }

        $hold = LibraryHold::firstOrCreate([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ], [
            'status' => 'active',
        ]);

        if ($hold->wasRecentlyCreated) {
            LibraryActivityLog::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'action' => 'library.hold_created',
                'meta' => [
                    'hold_id' => $hold->id,
                ],
            ]);

            $user->notify(new LibraryHoldCreated($hold));
        } else {
            session()->flash('library_status', 'You’re already on the waitlist for this book.');
            $this->note = '';
            return;
        }

        session()->flash('library_status', 'This book is currently on loan. You’ve been added to the waitlist.');

        $this->note = '';
    }

    public function render()
    {
        $books = collect();
        $podcasts = collect();
        $latestPosts = collect();
        $myLoanStatusesByBookId = [];
        $myHoldBookIds = [];

        if (Schema::hasTable('books')) {
            $books = Book::query()
                ->active()
                ->withCount([
                    'loans as reserved_count' => function ($q) {
                        $q->whereIn('status', ['approved', 'checked_out']);
                    },
                ])
                ->orderByDesc('is_featured')
                ->latest('created_at')
                ->take(12)
                ->get();
        }

        if (Auth::check() && Schema::hasTable('library_loans') && Schema::hasTable('library_holds')) {
            $userId = Auth::id();

            $myLoanStatusesByBookId = LibraryLoan::query()
                ->where('user_id', $userId)
                ->whereIn('status', ['requested', 'approved', 'checked_out'])
                ->pluck('status', 'book_id')
                ->all();

            $myHoldBookIds = LibraryHold::query()
                ->where('user_id', $userId)
                ->where('status', 'active')
                ->pluck('book_id')
                ->all();
        }

        if (Schema::hasTable('podcasts')) {
            $podcasts = Podcast::query()
                ->active()
                ->orderByDesc('is_featured')
                ->latest('listened_at')
                ->latest('created_at')
                ->take(12)
                ->get();
        }

        if (Schema::hasTable('blog_posts')) {
            $latestPosts = BlogPost::published()
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('livewire.library-page', [
            'books' => $books,
            'podcasts' => $podcasts,
            'latestPosts' => $latestPosts,
            'myLoanStatusesByBookId' => $myLoanStatusesByBookId,
            'myHoldBookIds' => $myHoldBookIds,
        ])->layout('layouts.app', ['title' => 'Library - Mutesilinda']);
    }
}
