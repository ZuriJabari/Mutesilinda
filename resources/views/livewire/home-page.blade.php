<div>
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-b from-white via-white to-gray-50/30 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 lg:pt-8 pb-4 sm:pb-6 lg:pb-0">
            <div class="grid lg:grid-cols-12 gap-6 sm:gap-8 lg:gap-16 items-center pt-2 lg:pt-3 pb-0">
                {{-- Text Content --}}
                <div class="lg:col-span-6 text-center lg:text-left space-y-6 sm:space-y-8 text-black order-2 lg:order-1 animate-fadeIn">
                    {{-- Hero Title with mobile-optimized sizes --}}
                    <h1 class="font-serif font-normal -tracking-[0.01em] leading-[0.85] sm:leading-tight">
                        <span class="block text-[26px] sm:text-[34px] md:text-[42px] lg:text-[50px] xl:text-[58px] text-gray-700">Hello, I'm</span>
                        <span class="block text-[34px] sm:text-[42px] md:text-[50px] xl:text-[66px] 2xl:text-[72px] mt-1 sm:mt-2 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 bg-clip-text text-transparent font-medium">Linda Mutesi!</span>
                    </h1>

                    {{-- Hero Subtitle --}}
                    <p class="text-base sm:text-lg md:text-xl lg:text-[22px] text-gray-600 leading-relaxed max-w-4xl mx-auto lg:mx-0 px-2 sm:px-0 font-light">
                        I work with artists, entrepreneurs, and civic leaders to grow opportunity across Uganda and beyond — nurturing creativity, championing women‑ and youth‑led enterprises, and advancing African philanthropy. This blog is where I bring these journeys together — reflections, behind‑the‑scenes insights, and conversations with fellow creatives. I invite you to join me on this journey.
                    </p>
                </div>

                {{-- Image --}}
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div class="relative w-full max-w-md mx-auto lg:max-w-none group">
                        <div class="absolute -inset-4 bg-gradient-to-r from-rose-100/40 via-pink-100/40 to-purple-100/40 rounded-2xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <img 
                            src="/images/linda-hero.png" 
                            alt="Linda Mutesi" 
                            class="relative w-full h-auto object-contain transform transition-transform duration-500 group-hover:scale-[1.02]"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mobile-optimized quick-links --}}
    <section class="w-full bg-gradient-to-b from-[#F6F1EE] to-[#F3EEE9] relative" x-data="{ emailRevealed: false, affiliationsExpanded: false }">
        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 items-stretch text-center text-gray-900 gap-0">
                {{-- Column 1 - Affiliations --}}
                <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 bg-[#F3EEE9] hover:bg-white hover:shadow-lg h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-visible">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <button @click="affiliationsExpanded = !affiliationsExpanded" class="relative block h-full w-full flex flex-col items-center justify-center cursor-pointer">
                        <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-rose-700 transition-all duration-300 font-semibold">Affiliations</span>
                        <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight group-hover:text-rose-800 transition-all duration-300 transform group-hover:scale-105">Organizations I Work With</span>
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

                {{-- Column 2 - Thinking About --}}
                <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 bg-[#EDE8F0] hover:bg-white hover:shadow-lg h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <a href="/blog" class="relative block h-full w-full flex flex-col items-center justify-center">
                        <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-purple-700 transition-all duration-300 font-semibold">Thinking About</span>
                        <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight px-2 group-hover:text-purple-800 transition-all duration-300 transform group-hover:scale-105">Reflections & Insights</span>
                    </a>
                </div>

                {{-- Column 3 - Research Interests --}}
                <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 bg-[#E7EFEA] hover:bg-white hover:shadow-lg h-full flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <a href="/research-interests" class="relative block h-full w-full flex flex-col items-center justify-center">
                        <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-green-700 transition-all duration-300 font-semibold">Research</span>
                        <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight group-hover:text-green-800 transition-all duration-300 transform group-hover:scale-105">Research Interests</span>
                    </a>
                </div>

                {{-- Column 4 - Get in Touch with Email Reveal --}}
                <div class="px-4 sm:px-6 py-6 sm:py-8 transition-all duration-500 bg-[#F3EEE9] hover:bg-white hover:shadow-lg h-full text-center flex flex-col items-center justify-center min-h-[120px] sm:min-h-[140px] group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative block h-full w-full max-w-sm flex flex-col items-center justify-center">
                        <span class="block text-xs sm:text-sm tracking-[0.2em] uppercase text-gray-500 group-hover:text-pink-700 transition-all duration-300 font-semibold">Get in Touch</span>
                        <span class="mt-3 sm:mt-4 block font-serif text-lg sm:text-xl md:text-[21px] font-semibold tracking-wide text-gray-900 leading-tight px-2 group-hover:text-pink-800 transition-all duration-300 transform group-hover:scale-105">Let's Connect</span>

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
            </div>
        </div>

        {{-- Affiliations Modal Overlay --}}
        <div 
            x-show="affiliationsExpanded"
            @click.self="affiliationsExpanded = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            style="display: none;"
        >
            <div 
                @click.stop
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="bg-white rounded-3xl shadow-2xl max-w-5xl w-full max-h-[85vh] overflow-y-auto"
            >
                {{-- Modal Header --}}
                <div class="sticky top-0 bg-gradient-to-r from-rose-50 to-pink-50 px-6 sm:px-8 py-6 border-b border-gray-200/60 rounded-t-3xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs sm:text-sm uppercase tracking-[0.2em] text-rose-600 font-semibold">Affiliations</div>
                            <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-gray-900">Organizations I Work With</h2>
                        </div>
                        <button 
                            @click="affiliationsExpanded = false"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-white hover:bg-gray-100 flex items-center justify-center transition-colors duration-200 shadow-sm"
                        >
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Modal Content --}}
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        {{-- Affiliation Card 1 --}}
                        <div class="group bg-gradient-to-br from-rose-50 to-white border border-rose-200/60 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-rose-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-rose-700 transition-colors">African Philanthropy Forum</h3>
                                    <p class="text-sm text-gray-600">Board Member</p>
                                </div>
                            </div>
                        </div>

                        {{-- Affiliation Card 2 --}}
                        <div class="group bg-gradient-to-br from-purple-50 to-white border border-purple-200/60 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-purple-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-purple-700 transition-colors">Uganda Arts Trust</h3>
                                    <p class="text-sm text-gray-600">Executive Director</p>
                                </div>
                            </div>
                        </div>

                        {{-- Affiliation Card 3 --}}
                        <div class="group bg-gradient-to-br from-green-50 to-white border border-green-200/60 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-green-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-green-700 transition-colors">Women's Entrepreneurship Network</h3>
                                    <p class="text-sm text-gray-600">Advisory Board</p>
                                </div>
                            </div>
                        </div>

                        {{-- Affiliation Card 4 --}}
                        <div class="group bg-gradient-to-br from-amber-50 to-white border border-amber-200/60 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-amber-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-amber-700 transition-colors">Youth Leadership Initiative</h3>
                                    <p class="text-sm text-gray-600">Founding Member</p>
                                </div>
                            </div>
                        </div>

                        {{-- Affiliation Card 5 --}}
                        <div class="group bg-gradient-to-br from-blue-50 to-white border border-blue-200/60 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-blue-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-blue-700 transition-colors">East African Creative Economy</h3>
                                    <p class="text-sm text-gray-600">Strategic Advisor</p>
                                </div>
                            </div>
                        </div>

                        {{-- Affiliation Card 6 --}}
                        <div class="group bg-gradient-to-br from-pink-50 to-white border border-pink-200/60 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-pink-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-pink-700 transition-colors">Community Development Foundation</h3>
                                    <p class="text-sm text-gray-600">Board Chair</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
