<div>
    {{-- Hero Section --}}
    @if($heroSection)
    <section class="relative bg-gradient-to-b from-white via-white to-gray-50/30 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 lg:pt-8 pb-4 sm:pb-6 lg:pb-0">
            <div class="grid lg:grid-cols-12 gap-6 sm:gap-8 lg:gap-16 items-center pt-2 lg:pt-3 pb-0">
                {{-- Text Content --}}
                <div class="lg:col-span-6 text-center lg:text-left space-y-6 sm:space-y-8 text-black order-2 lg:order-1 animate-fadeIn">
                    {{-- Hero Title with mobile-optimized sizes --}}
                    <h1 class="font-serif -tracking-[0.02em] leading-[0.9] sm:leading-[0.95] text-[48px] sm:text-[62px] md:text-[76px] lg:text-[90px] xl:text-[104px] 2xl:text-[116px]">
                        <span class="block text-gray-600 font-light">{{ $heroSection->greeting }}</span>
                        <span class="block mt-2 sm:mt-3 bg-gradient-to-r from-gray-900 via-rose-900 to-gray-900 bg-clip-text text-transparent font-bold tracking-tight">{{ $heroSection->name }}</span>
                    </h1>

                    {{-- Hero Subtitle --}}
                    <p class="text-base sm:text-lg md:text-xl lg:text-[22px] text-gray-600 leading-relaxed max-w-4xl mx-auto lg:mx-0 px-2 sm:px-0 font-light">
                        {{ $heroSection->description }}
                    </p>
                </div>

                {{-- Image --}}
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div class="relative w-full max-w-md mx-auto lg:max-w-none group">
                        <div class="absolute -inset-4 bg-gradient-to-r from-rose-100/40 via-pink-100/40 to-purple-100/40 rounded-2xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <img 
                            src="{{ $heroSection->image_path }}" 
                            alt="{{ $heroSection->name }}" 
                            class="relative w-full h-auto object-contain transform transition-transform duration-500 group-hover:scale-[1.02]"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Mobile-optimized quick-links --}}
    <section class="w-full bg-gradient-to-b from-[#F6F1EE] to-[#F3EEE9] relative" x-data="{ emailRevealed: false, affiliationsExpanded: false }">
        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 items-stretch text-center text-gray-900 gap-0">
                @foreach($quickLinks as $index => $link)
                    @if($link->label === 'Affiliations')
                        {{-- Affiliations with dropdown --}}
                        <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 hover:bg-white hover:shadow-lg h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-visible" style="background-color: {{ $link->bg_color }}">
                            <div class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <button @click="affiliationsExpanded = !affiliationsExpanded" class="relative block h-full w-full flex flex-col items-center justify-center cursor-pointer">
                                <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-rose-700 transition-all duration-300 font-semibold">{{ $link->label }}</span>
                                <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight group-hover:text-rose-800 transition-all duration-300 transform group-hover:scale-105">{{ $link->title }}</span>
                                <svg 
                                    class="w-5 h-5 mt-2 transition-transform duration-300" 
                                    :class="affiliationsExpanded ? 'rotate-180' : ''"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    @elseif($link->label === 'Get in Touch')
                        {{-- Get in Touch with Email Reveal --}}
                        <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 hover:bg-white hover:shadow-lg h-full text-center flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-hidden" style="background-color: {{ $link->bg_color }}">
                            <div class="absolute inset-0 bg-gradient-to-br from-pink-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative block h-full w-full max-w-sm flex flex-col items-center justify-center">
                                <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-pink-700 transition-all duration-300 font-semibold">{{ $link->label }}</span>
                                <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight px-2 group-hover:text-pink-800 transition-all duration-300 transform group-hover:scale-105">{{ $link->title }}</span>

                                <div class="mt-4 sm:mt-5 w-full">
                                    <template x-if="!emailRevealed">
                                        <button
                                            @click="emailRevealed = true"
                                            class="group relative w-full px-4 sm:px-6 py-3 rounded-full bg-gradient-to-r from-rose-600 via-pink-600 to-rose-600 text-white font-medium text-sm sm:text-base hover:shadow-xl hover:shadow-rose-500/30 transition-all duration-500 transform hover:-translate-y-1 hover:scale-105 min-h-[44px] overflow-hidden"
                                        >
                                            <span class="relative z-10 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                Send Me an Email
                                            </span>
                                            <span class="absolute inset-0 bg-gradient-to-r from-pink-600 via-rose-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                                            <span class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                                        </button>
                                    </template>
                                    <template x-if="emailRevealed">
                                        <div class="animate-fadeIn">
                                            <a
                                                href="mailto:linda@mutesilinda.com"
                                                class="block w-full px-3 sm:px-4 py-3 rounded-full bg-white border-2 border-rose-500 text-rose-700 font-medium text-xs sm:text-sm hover:bg-rose-50 transition-all duration-300 transform hover:-translate-y-0.5 min-h-[44px] flex items-center justify-center gap-2"
                                            >
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                                </svg>
                                                linda@mutesilinda.com
                                            </a>
                                            <button
                                                @click="emailRevealed = false"
                                                class="mt-2 text-xs text-gray-500 hover:text-gray-700 underline transition-colors"
                                            >
                                                Hide
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Regular Quick Link --}}
                        <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 hover:bg-white hover:shadow-lg h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-hidden" style="background-color: {{ $link->bg_color }}">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <a href="{{ $link->url }}" class="relative block h-full w-full flex flex-col items-center justify-center">
                                <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-purple-700 transition-all duration-300 font-semibold">{{ $link->label }}</span>
                                <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight px-2 group-hover:text-purple-800 transition-all duration-300 transform group-hover:scale-105">{{ $link->title }}</span>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Simple Affiliations List --}}
            <div 
                x-show="affiliationsExpanded"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0"
                x-transition:enter-end="opacity-100 max-h-96"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 max-h-96"
                x-transition:leave-end="opacity-0 max-h-0"
                class="w-full bg-white/80 backdrop-blur-sm border-t border-gray-200/60 overflow-hidden"
            >
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-center sm:text-left">
                        @foreach($affiliations as $affiliation)
                            <li><a href="{{ $affiliation->url }}" target="_blank" rel="noopener noreferrer" class="text-gray-700 hover:text-rose-700 hover:underline transition-colors">{{ $affiliation->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Article Section --}}
    @if($featuredPost)
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-white to-gray-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 sm:mb-10 md:text-left text-center">
                <div class="text-[10px] sm:text-[11px] uppercase tracking-[0.3em] text-gray-500 font-medium">Featured</div>
                <h2 class="mt-2 text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">Latest Article</h2>
                <div class="mt-3 h-0.5 w-16 bg-gradient-to-r from-rose-600 to-pink-600 md:ml-0 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-12 gap-6 sm:gap-8 lg:gap-12">
                {{-- Featured card (left) --}}
                <div class="md:col-span-7">
                    <article class="group bg-white border border-gray-200/60 rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-gray-900/10">
                        @if($featuredPost->featured_image)
                            <a href="/blog/{{ $featuredPost->slug }}" class="block">
                                <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}" class="w-full h-64 md:h-80 object-cover transition-transform duration-700 ease-out group-hover:scale-110" />
                            </a>
                        @else
                            <div class="w-full h-40 md:h-56 bg-gray-100 flex items-center justify-center text-gray-400 text-[18px]">Image coming soon</div>
                        @endif
                        <div class="p-6 md:p-8 text-left">
                            @if($featuredPost->published_at)
                                <time class="text-xs uppercase tracking-[0.25em] text-gray-500">{{ $featuredPost->published_at->format('F j, Y') }}</time>
                            @endif
                            <h3 class="mt-3 text-2xl md:text-3xl font-bold text-gray-900 leading-tight">
                                <a href="/blog/{{ $featuredPost->slug }}" class="hover:text-rose-700 transition-colors duration-300">{{ $featuredPost->title }}</a>
                            </h3>
                            @if($featuredPost->subtitle)
                                <p class="mt-2 text-lg text-gray-600">{{ $featuredPost->subtitle }}</p>
                            @endif
                            @if($featuredPost->excerpt)
                                <p class="mt-4 text-gray-700 leading-relaxed">{{ Str::limit($featuredPost->excerpt, 200) }}</p>
                            @endif
                            <div class="mt-6">
                                <a href="/blog/{{ $featuredPost->slug }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-gray-900 to-gray-800 text-white font-medium hover:shadow-lg hover:shadow-gray-900/30 transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-105">
                                    Read More
                                    <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                {{-- More Stories (right) --}}
                @if($recentPosts->count() > 0)
                <aside class="md:col-span-5">
                    <div class="mb-4 text-center md:text-left">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">More</div>
                        <h3 class="mt-1 text-xl md:text-2xl font-extrabold text-black">Recent Stories</h3>
                        <div class="mt-2 h-px w-12 bg-black/60 mx-auto md:ml-0"></div>
                    </div>
                    
                    <ul class="bg-white border border-gray-200/60 rounded-2xl divide-y divide-gray-200/60 shadow-sm hover:shadow-md transition-shadow duration-300">
                        @foreach($recentPosts as $post)
                            <li class="group">
                                <a href="/blog/{{ $post->slug }}" class="flex items-start gap-4 p-5 md:p-6 transition-all duration-300 hover:bg-gradient-to-r hover:from-gray-50 hover:to-white">
                                    <div class="flex-1">
                                        <h4 class="text-base md:text-lg font-medium text-black group-hover:underline">{{ $post->title }}</h4>
                                        @if($post->subtitle)
                                            <p class="mt-1 text-[18px] text-gray-600 line-clamp-2">{{ $post->subtitle }}</p>
                                        @endif
                                    </div>
                                    <span class="text-gray-400 group-hover:text-black transition-all duration-200 transform group-hover:translate-x-1" aria-hidden="true">→</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 text-right">
                        <a href="/blog" class="inline-flex items-center gap-1 text-[18px] font-medium text-black hover:underline">
                            View more
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </aside>
                @endif
            </div>
        </div>
    </section>
    @endif
</div>
