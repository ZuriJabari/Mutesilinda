<div>
    {{-- Success is as dangerous as failure. --}}
    <div>
        {{-- Article Header --}}
        <article class="bg-white">
            <x-inner-hero
                kicker="Thinking About"
                :title="$post->title"
                :subtitle="$post->subtitle"
                :breadcrumbs="[
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Blog', 'url' => '/blog'],
                    ['label' => $post->title],
                ]"
            >
                <x-slot:meta>
                    @if($post->published_at)
                        <div class="mt-6 flex flex-wrap items-center gap-x-3 gap-y-2 text-sm uppercase tracking-wider text-gray-500">
                            <time>{{ $post->published_at->format('F j, Y') }}</time>
                            <span class="text-gray-300">/</span>
                            <span>{{ $readingTimeMinutes }} min read</span>
                        </div>
                    @endif
                </x-slot:meta>

                <div class="mt-8 pt-8 border-t border-gray-200/70">
                    <div class="flex flex-wrap items-center gap-3" x-data="{ copied: false }">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Share</div>
                        <a
                            href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-brands fa-x-twitter transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share on X</span>
                        </a>
                        <a
                            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-brands fa-linkedin-in transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share on LinkedIn</span>
                        </a>
                        <a
                            href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-brands fa-whatsapp transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share on WhatsApp</span>
                        </a>
                        <a
                            href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(url()->current()) }}"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-regular fa-envelope transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share via Email</span>
                        </a>

                        <button
                            type="button"
                            @click="navigator.clipboard.writeText('{{ url()->current() }}'); copied = true; setTimeout(() => copied = false, 1500)"
                            class="group inline-flex h-11 items-center justify-center rounded-full border border-gray-200 bg-white px-4 text-sm text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-solid fa-link text-[16px] transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="ml-2" x-show="!copied">Copy link</span>
                            <span class="ml-2" x-show="copied" x-cloak>Copied</span>
                        </button>
                    </div>
                </div>
            </x-inner-hero>

            @if($post->featured_image)
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
                    <figure class="">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow-2xl" />

                        @if($post->featured_image_caption)
                            <figcaption class="mt-4 text-center text-sm text-zinc-600 leading-relaxed">
                                {{ $post->featured_image_caption }}
                            </figcaption>
                        @endif
                    </figure>
                </div>
            @endif

            {{-- Article Content --}}
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="article-prose prose prose-zinc max-w-none prose-headings:font-serif prose-headings:tracking-[0.02em] prose-headings:text-zinc-950 prose-h1:text-3xl sm:prose-h1:text-4xl prose-h1:leading-[1.05] prose-h2:text-2xl sm:prose-h2:text-3xl prose-h2:leading-tight prose-p:text-[20px] sm:prose-p:text-[21px] prose-p:leading-[1.95] prose-p:text-zinc-800 prose-strong:text-zinc-950 prose-a:text-rose-800 prose-a:no-underline hover:prose-a:underline prose-img:rounded-2xl">
                    {!! $renderedContent !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-200/70">
                    <div class="flex flex-wrap items-center gap-3" x-data="{ copied: false }">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Share</div>
                        <a
                            href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-brands fa-x-twitter transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share on X</span>
                        </a>
                        <a
                            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-brands fa-linkedin-in transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share on LinkedIn</span>
                        </a>
                        <a
                            href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-brands fa-whatsapp transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share on WhatsApp</span>
                        </a>
                        <a
                            href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(url()->current()) }}"
                            class="group relative inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white text-[18px] text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-regular fa-envelope transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="sr-only">Share via Email</span>
                        </a>

                        <button
                            type="button"
                            @click="navigator.clipboard.writeText('{{ url()->current() }}'); copied = true; setTimeout(() => copied = false, 1500)"
                            class="group inline-flex h-11 items-center justify-center rounded-full border border-gray-200 bg-white px-4 text-sm text-gray-800 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-900/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                        >
                            <i class="fa-solid fa-link text-[16px] transition-transform duration-300 ease-out group-hover:scale-110" aria-hidden="true"></i>
                            <span class="ml-2" x-show="!copied">Copy link</span>
                            <span class="ml-2" x-show="copied" x-cloak>Copied</span>
                        </button>
                    </div>
                </div>

                @if($relatedPosts->count() > 0)
                    <div class="mt-16 pt-10 border-t border-gray-200/70">
                        <div class="text-[11px] uppercase tracking-[0.3em] text-gray-500">Continue Reading</div>
                        <h2 class="mt-3 font-serif text-3xl sm:text-4xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">
                            More Articles
                        </h2>
                        <div class="mt-4 h-px w-16 bg-zinc-950/60"></div>

                        <div class="mt-10 grid md:grid-cols-3 gap-6">
                            @foreach($relatedPosts as $related)
                                <article class="group rounded-2xl border border-gray-200/70 bg-white overflow-hidden transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl hover:shadow-gray-900/10">
                                    <a href="/blog/{{ $related->slug }}" class="block">
                                        @if($related->featured_image)
                                            <img src="{{ $related->featured_image }}" alt="{{ $related->title }}" class="h-48 w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" />
                                        @else
                                            <div class="h-48 w-full bg-gray-100"></div>
                                        @endif

                                        <div class="p-6">
                                            @if($related->published_at)
                                                <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">
                                                    {{ $related->published_at->format('F j, Y') }}
                                                </div>
                                            @endif

                                            <h3 class="mt-3 font-serif text-xl font-medium tracking-[0.01em] leading-tight text-zinc-950 group-hover:text-rose-800 transition-colors">
                                                {{ $related->title }}
                                            </h3>

                                            @if($related->subtitle)
                                                <p class="mt-2 text-[15px] leading-relaxed text-gray-600 line-clamp-2">
                                                    {{ $related->subtitle }}
                                                </p>
                                            @endif

                                            <div class="mt-5 inline-flex items-center gap-2 text-[12px] uppercase tracking-[0.28em] text-gray-700 group-hover:text-zinc-950 transition-colors">
                                                Read
                                                <i class="fa-solid fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </div>
</div>
