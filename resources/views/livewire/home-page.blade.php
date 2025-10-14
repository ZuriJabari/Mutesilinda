<div>
    {{-- Hero Section --}}
    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 md:py-24 lg:py-28">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                {{-- Text Content --}}
                <div class="lg:col-span-6 text-center lg:text-left space-y-6 sm:space-y-8 text-black order-2 lg:order-1">
                    {{-- Hero Title with mobile-optimized sizes --}}
                    <h1 class="font-serif font-semibold -tracking-[0.01em] leading-[0.85] sm:leading-tight">
                        <span class="block text-[27px] sm:text-[36px] md:text-[45px] lg:text-[54px] xl:text-[63px]">Hello, I'm</span>
                        <span class="block text-[36px] sm:text-[45px] md:text-[54px] lg:text-[63px] xl:text-[72px] 2xl:text-[79px] mt-1 sm:mt-2">Linda Mutesi!</span>
                    </h1>

                    {{-- Hero Subtitle --}}
                    <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-700 leading-relaxed max-w-4xl mx-auto lg:mx-0 px-2 sm:px-0">
                        I work with artists, entrepreneurs, and civic leaders to grow opportunity across Uganda and beyond — nurturing creativity, championing women‑ and youth‑led enterprises, and advancing African philanthropy. This blog is where I bring these journeys together — reflections, behind‑the‑scenes insights, and conversations with fellow creatives. I invite you to join me on this journey.
                    </p>
                </div>

                {{-- Image --}}
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div class="relative w-full max-w-md mx-auto lg:max-w-none aspect-square">
                        <img 
                            src="/images/linda-hero.png" 
                            alt="Linda Mutesi" 
                            class="relative z-10 w-full h-full object-cover"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mobile-optimized quick-links --}}
    <section class="w-full bg-[#F6F1EE]" x-data="{ emailRevealed: false }">
        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 items-stretch text-center text-gray-900">
                {{-- Column 1 - Affiliations --}}
                <div class="md:border-r md:border-gray-200 border-b sm:border-b-0 md:border-b border-gray-200 px-4 sm:px-6 py-6 sm:py-8 transition-all duration-300 bg-[#F3EEE9] hover:bg-[#EAE4DE] h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group">
                    <a href="#affiliations" class="block h-full w-full flex flex-col items-center justify-center">
                        <span class="block text-[10px] sm:text-[11px] md:text-xs tracking-[0.28em] uppercase text-gray-600 group-hover:text-gray-900 transition-colors">Affiliations</span>
                        <span class="mt-2 sm:mt-3 block font-serif text-base sm:text-lg md:text-[19px] font-semibold tracking-wide text-gray-900 leading-tight group-hover:text-rose-800 transition-colors">Organizations I Work With</span>
                    </a>
                </div>

                {{-- Column 2 - Thinking About --}}
                <div class="md:border-r md:border-gray-200 border-b sm:border-b-0 md:border-b border-gray-200 px-4 sm:px-6 py-6 sm:py-8 transition-all duration-300 bg-[#EDE8F0] hover:bg-[#E7E1EC] h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group">
                    <a href="/blog" class="block h-full w-full flex flex-col items-center justify-center">
                        <span class="block text-[10px] sm:text-[11px] md:text-xs tracking-[0.28em] uppercase text-gray-600 group-hover:text-gray-900 transition-colors">Thinking About</span>
                        <span class="mt-2 sm:mt-3 block font-serif text-base sm:text-lg md:text-[19px] font-semibold tracking-wide text-gray-900 leading-tight px-2 group-hover:text-purple-800 transition-colors">Reflections & Insights</span>
                    </a>
                </div>

                {{-- Column 3 - Research Interests --}}
                <div class="md:border-r md:border-gray-200 border-b sm:border-b-0 md:border-b border-gray-200 px-4 sm:px-6 py-6 sm:py-8 transition-all duration-300 bg-[#E7EFEA] hover:bg-[#DFEAE5] h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group">
                    <a href="/research-interests" class="block h-full w-full flex flex-col items-center justify-center">
                        <span class="block text-[10px] sm:text-[11px] md:text-xs tracking-[0.28em] uppercase text-gray-600 group-hover:text-gray-900 transition-colors">Research Interests</span>
                        <span class="mt-2 sm:mt-3 block font-serif text-base sm:text-lg md:text-[19px] font-semibold tracking-wide text-gray-900 leading-tight group-hover:text-green-800 transition-colors">Academic Focus Areas</span>
                    </a>
                </div>

                {{-- Column 4 - Get in Touch with Email Reveal --}}
                <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-300 bg-[#F3EEE9] hover:bg-[#EAE4DE] h-full text-center flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px]">
                    <div class="block h-full w-full max-w-sm flex flex-col items-center justify-center">
                        <span class="block text-[10px] sm:text-[11px] md:text-xs tracking-[0.28em] uppercase text-gray-600">Get in Touch</span>
                        <span class="mt-2 sm:mt-3 block font-serif text-base sm:text-lg md:text-[19px] font-semibold tracking-wide text-gray-900 leading-tight px-2">Let's Connect</span>

                        <div class="mt-4 sm:mt-5 w-full">
                            <template x-if="!emailRevealed">
                                <button
                                    @click="emailRevealed = true"
                                    class="group relative w-full px-4 sm:px-6 py-3 rounded-full bg-gradient-to-r from-rose-600 to-pink-600 text-white font-medium text-sm sm:text-base hover:from-rose-700 hover:to-pink-700 transition-all duration-300 transform hover:-translate-y-0.5 min-h-[44px] overflow-hidden"
                                >
                                    <span class="relative z-10 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Send Me an Email
                                    </span>
                                    <span class="absolute inset-0 bg-gradient-to-r from-pink-600 to-rose-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
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
            </div>
        </div>
    </section>

    {{-- Featured Article Section --}}
    @if($featuredPost)
    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 sm:mb-8 md:text-left text-center">
                <div class="text-[10px] sm:text-[11px] uppercase tracking-[0.28em] text-gray-500">Featured</div>
                <h2 class="mt-1 text-xl sm:text-2xl md:text-3xl font-extrabold text-black">Latest Article</h2>
                <div class="mt-2 h-px w-12 bg-black/60 md:ml-0 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-12 gap-6 sm:gap-8 lg:gap-12">
                {{-- Featured card (left) --}}
                <div class="md:col-span-7">
                    <article class="group bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:-translate-y-1">
                        @if($featuredPost->featured_image)
                            <a href="/blog/{{ $featuredPost->slug }}" class="block">
                                <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}" class="w-full h-64 md:h-80 object-cover transition-transform duration-500 ease-out group-hover:scale-105" />
                            </a>
                        @else
                            <div class="w-full h-40 md:h-56 bg-gray-100 flex items-center justify-center text-gray-400 text-[18px]">Image coming soon</div>
                        @endif
                        <div class="p-6 md:p-8 text-left">
                            @if($featuredPost->published_at)
                                <time class="text-xs uppercase tracking-[0.25em] text-gray-500">{{ $featuredPost->published_at->format('F j, Y') }}</time>
                            @endif
                            <h3 class="mt-3 text-2xl md:text-3xl font-bold text-black leading-tight">
                                <a href="/blog/{{ $featuredPost->slug }}" class="hover:underline">{{ $featuredPost->title }}</a>
                            </h3>
                            @if($featuredPost->subtitle)
                                <p class="mt-2 text-lg text-gray-600">{{ $featuredPost->subtitle }}</p>
                            @endif
                            @if($featuredPost->excerpt)
                                <p class="mt-4 text-gray-700 leading-relaxed">{{ Str::limit($featuredPost->excerpt, 200) }}</p>
                            @endif
                            <div class="mt-6">
                                <a href="/blog/{{ $featuredPost->slug }}" class="inline-flex items-center gap-2 text-black font-semibold hover:underline">
                                    Read More
                                    <span aria-hidden="true">→</span>
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
                    
                    <ul class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-200">
                        @foreach($recentPosts as $post)
                            <li class="group">
                                <a href="/blog/{{ $post->slug }}" class="flex items-start gap-4 p-5 md:p-6 transition-all duration-200 hover:bg-gray-50">
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
