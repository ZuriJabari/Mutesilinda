<div>
    <x-inner-hero
        kicker="Latest Books & Podcasts"
        title="The Mutesi Library"
        subtitle="Book recommendations you can borrow, and podcasts I’m currently listening to."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Library'],
        ]"
    >
        @if(session('library_status'))
            <div class="mt-10 rounded-2xl border border-gray-200/70 bg-white px-6 py-5 shadow-2xl shadow-gray-900/5">
                <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Library</div>
                <div class="mt-2 text-gray-900">{{ session('library_status') }}</div>
            </div>
        @endif
    </x-inner-hero>

    <section class="pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-6 pt-10">
                <div>
                    <div class="text-[11px] uppercase tracking-[0.3em] text-gray-500">From the shelves</div>
                    <h2 class="mt-3 font-serif text-3xl sm:text-4xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">
                        Book Recommendations
                    </h2>
                    <div class="mt-4 h-px w-16 bg-zinc-950/60"></div>
                </div>
                @guest('web')
                    <a href="{{ route('login', ['redirect' => route('library', absolute: false)]) }}" class="hidden sm:inline-flex items-center rounded-full border border-gray-200 bg-white px-5 py-2.5 text-[12px] uppercase tracking-[0.28em] text-gray-800 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                        Sign in to Borrow
                    </a>
                @endguest
            </div>

            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($books as $book)
                    <article class="group rounded-2xl border border-gray-200/70 bg-white p-6 shadow-2xl shadow-gray-900/5 transition-all duration-500 hover:-translate-y-1 hover:border-gray-300 hover:shadow-2xl hover:shadow-gray-900/10">
                        <div class="flex gap-5">
                            <div class="shrink-0">
                                @if($book->cover_image)
                                    <img
                                        src="{{ $book->cover_image }}"
                                        alt="{{ $book->title }}"
                                        class="h-32 w-24 rounded-2xl object-cover ring-1 ring-gray-200/70 transition-transform duration-500 group-hover:scale-[1.03]"
                                        loading="lazy"
                                    />
                                @else
                                    <div class="h-32 w-24 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 ring-1 ring-gray-200/70 flex items-center justify-center">
                                        <div class="font-serif text-4xl text-gray-400">
                                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($book->title, 0, 1)) }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="min-w-0">
                                @php
                                    $myStatus = $myLoanStatusesByBookId[$book->id] ?? null;
                                    $isOnWaitlist = in_array($book->id, $myHoldBookIds ?? [], true);
                                @endphp

                                <div class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-[11px] uppercase tracking-[0.28em] text-gray-700">
                                    {{ $book->reserved_count > 0 ? 'On loan' : 'Available' }}
                                </div>

                                <h3 class="mt-3 font-serif text-xl font-medium tracking-[0.01em] leading-tight text-zinc-950">
                                    {{ $book->title }}
                                </h3>

                                @if($book->author)
                                    <div class="mt-2 text-[11px] uppercase tracking-[0.28em] text-gray-500">
                                        {{ $book->author }}
                                    </div>
                                @endif

                                @if($book->description)
                                    <p class="mt-3 text-[15px] leading-relaxed text-gray-700 line-clamp-3">
                                        {{ $book->description }}
                                    </p>
                                @endif

                                <div class="mt-5">
                                    @auth('web')
                                        @php
                                            $ctaDisabled = $myStatus !== null || $isOnWaitlist;
                                            $ctaLabel = match ($myStatus) {
                                                'requested' => 'Requested',
                                                'approved' => 'Approved',
                                                'checked_out' => 'Checked out',
                                                default => ($isOnWaitlist ? 'On waitlist' : ($book->reserved_count > 0 ? 'Join waitlist' : 'Request to borrow')),
                                            };
                                        @endphp

                                        <button
                                            type="button"
                                            wire:click="openBorrowModal({{ $book->id }})"
                                            @disabled($ctaDisabled)
                                            class="group inline-flex h-11 items-center justify-center rounded-full bg-zinc-950 px-5 text-[12px] uppercase tracking-[0.28em] text-white transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-zinc-900 hover:shadow-lg hover:shadow-gray-900/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:translate-y-0"
                                        >
                                            <span>{{ $ctaLabel }}</span>
                                            <i class="fa-solid fa-arrow-right text-[11px] ml-2 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
                                        </button>
                                    @endauth

                                    @guest('web')
                                        <a
                                            href="{{ route('login', ['redirect' => route('library', absolute: false)]) }}"
                                            class="group inline-flex h-11 items-center justify-center rounded-full border border-gray-200 bg-white px-5 text-[12px] uppercase tracking-[0.28em] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:bg-gray-50 hover:shadow-lg hover:shadow-gray-900/10"
                                        >
                                            Sign in to borrow
                                            <i class="fa-solid fa-arrow-right text-[11px] ml-2 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="sm:col-span-2 lg:col-span-3 rounded-2xl border border-gray-200/70 bg-white p-8">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Books</div>
                        <div class="mt-2 text-gray-900">No book recommendations yet.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @auth('web')
        @if($showBorrowModal)
            <div class="fixed inset-0 z-[200]">
                <div class="absolute inset-0 bg-black/50" wire:click="closeBorrowModal"></div>
                <div class="absolute inset-0 flex items-center justify-center px-4 sm:px-6">
                    <div class="w-full max-w-lg rounded-3xl border border-gray-200/70 bg-white p-7 shadow-2xl shadow-gray-900/20">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Borrow request</div>
                        <h3 class="mt-3 font-serif text-2xl font-medium tracking-[0.01em] leading-tight text-zinc-950">Add a note (optional)</h3>
                        <p class="mt-3 text-[15px] leading-relaxed text-gray-700">
                            If you’d like, include a short message to accompany your request.
                        </p>

                        <textarea wire:model.defer="note" rows="4" class="mt-5 w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-800 focus:border-gray-300 focus:ring-rose-200/60"></textarea>

                        <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                            <button type="button" wire:click="closeBorrowModal" class="inline-flex h-11 items-center justify-center rounded-full border border-gray-200 bg-white px-5 text-[12px] uppercase tracking-[0.28em] text-gray-800 transition-colors hover:border-gray-300 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="button" wire:click="confirmBorrow" wire:loading.attr="disabled" wire:target="confirmBorrow" class="group inline-flex h-11 items-center justify-center rounded-full bg-zinc-950 px-6 text-[12px] uppercase tracking-[0.28em] text-white transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-zinc-900 hover:shadow-lg hover:shadow-gray-900/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:translate-y-0">
                                <span wire:loading.remove wire:target="confirmBorrow">Send request</span>
                                <span wire:loading wire:target="confirmBorrow">Sending…</span>
                                <i class="fa-solid fa-arrow-right text-[11px] ml-2 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <section class="border-t border-gray-200/70 bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div>
                <div class="text-[11px] uppercase tracking-[0.3em] text-gray-500">On my headphones</div>
                <h2 class="mt-3 font-serif text-3xl sm:text-4xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">
                    Podcasts I’m Listening To
                </h2>
                <div class="mt-4 h-px w-16 bg-zinc-950/60"></div>
            </div>

            <div class="mt-10 grid lg:grid-cols-2 gap-6">
                @forelse($podcasts as $podcast)
                    <article class="group rounded-2xl border border-gray-200/70 bg-white p-6 shadow-2xl shadow-gray-900/5 transition-all duration-500 hover:-translate-y-1 hover:border-gray-300 hover:shadow-2xl hover:shadow-gray-900/10">
                        @if($podcast->show_name)
                            <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">
                                {{ $podcast->show_name }}
                            </div>
                        @endif

                        <h3 class="mt-2 font-serif text-xl font-medium tracking-[0.01em] leading-tight text-zinc-950">
                            {{ $podcast->title }}
                        </h3>

                        @if($podcast->description)
                            <p class="mt-3 text-[15px] leading-relaxed text-gray-700 line-clamp-3">
                                {{ $podcast->description }}
                            </p>
                        @endif

                        @if($podcast->embed_html)
                            <div class="mt-5 overflow-hidden rounded-xl border border-gray-200/70 bg-white transition-colors duration-300 group-hover:border-gray-300">
                                {!! $podcast->embed_html !!}
                            </div>
                        @endif

                        @if(!$podcast->embed_html && $podcast->external_url)
                            <a href="{{ $podcast->external_url }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center gap-2 text-[12px] uppercase tracking-[0.28em] text-gray-700 hover:text-zinc-950 transition-colors">
                                Listen
                                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]" aria-hidden="true"></i>
                            </a>
                        @endif
                    </article>
                @empty
                    <div class="lg:col-span-2 rounded-2xl border border-gray-200/70 bg-white p-8">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Podcasts</div>
                        <div class="mt-2 text-gray-900">No podcasts added yet.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="border-t border-gray-200/70 bg-white py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <div class="text-[11px] uppercase tracking-[0.3em] text-gray-500">Writing</div>
                    <h2 class="mt-3 font-serif text-3xl sm:text-4xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">
                        My latest thoughts
                    </h2>
                    <div class="mt-4 h-px w-16 bg-zinc-950/60"></div>
                </div>
                <a href="/blog" class="hidden sm:inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-5 py-2.5 text-[12px] uppercase tracking-[0.28em] text-gray-800 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                    View all
                    <i class="fa-solid fa-arrow-right text-[11px]" aria-hidden="true"></i>
                </a>
            </div>

            <div class="mt-10 grid md:grid-cols-2 gap-6">
                @forelse($latestPosts as $post)
                    <article class="group rounded-3xl border border-gray-200/70 bg-white p-7 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:border-gray-300 hover:shadow-2xl hover:shadow-gray-900/10">
                        <div class="flex gap-5">
                            <a href="/blog/{{ $post->slug }}" class="shrink-0">
                                @if($post->featured_image)
                                    <img
                                        src="{{ $post->featured_image }}"
                                        alt="{{ $post->title }}"
                                        class="h-28 w-28 rounded-2xl object-cover ring-1 ring-gray-200/70 transition-transform duration-500 group-hover:scale-[1.03]"
                                        loading="lazy"
                                    />
                                @else
                                    <div class="h-28 w-28 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 ring-1 ring-gray-200/70 flex items-center justify-center">
                                        <div class="font-serif text-3xl text-gray-400">
                                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($post->title, 0, 1)) }}
                                        </div>
                                    </div>
                                @endif
                            </a>

                            <div class="min-w-0">
                                @if($post->published_at)
                                    <time class="text-[11px] uppercase tracking-[0.28em] text-gray-500">{{ $post->published_at->format('F j, Y') }}</time>
                                @endif

                                <h3 class="mt-3 font-serif text-2xl font-medium tracking-[0.01em] leading-tight text-zinc-950">
                                    <a href="/blog/{{ $post->slug }}" class="hover:underline">{{ $post->title }}</a>
                                </h3>

                                @if($post->subtitle)
                                    <p class="mt-3 text-[15px] leading-relaxed text-gray-700 line-clamp-2">{{ $post->subtitle }}</p>
                                @elseif($post->excerpt)
                                    <p class="mt-3 text-[15px] leading-relaxed text-gray-700 line-clamp-3">{{ \Illuminate\Support\Str::limit($post->excerpt, 160) }}</p>
                                @endif

                                <div class="mt-6">
                                    <a href="/blog/{{ $post->slug }}" class="inline-flex items-center gap-2 text-[12px] uppercase tracking-[0.28em] text-gray-800 transition-colors hover:text-zinc-950">
                                        Read
                                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 rounded-2xl border border-gray-200/70 bg-white p-8">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Blog</div>
                        <div class="mt-2 text-gray-900">No published posts yet.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 sm:hidden">
                <a href="/blog" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-5 py-2.5 text-[12px] uppercase tracking-[0.28em] text-gray-800 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                    View all
                    <i class="fa-solid fa-arrow-right text-[11px]" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
</div>
