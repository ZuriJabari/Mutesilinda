@php
    use App\Models\MenuItem;
    use App\Models\Affiliation;
    
    $menuItems = MenuItem::where('is_active', true)->orderBy('order')->get();
    $affiliations = Affiliation::where('is_active', true)->orderBy('order')->get();
@endphp

<header x-data="{ 
    isScrolled: false, 
    isOverlayOpen: false,
    isAffiliationsOpen: false,
    init() {
        window.addEventListener('scroll', () => {
            this.isScrolled = window.scrollY > 50;
        });
    }
}" 
:class="isScrolled ? 'bg-white/95 backdrop-blur-md shadow-sm' : 'bg-transparent'" 
class="relative z-[100] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo - Simple & Elegant -->
            <a href="/" class="flex-shrink-0 select-none py-2 group" aria-label="Mutesilinda.com Home">
                <span class="font-serif text-2xl sm:text-3xl md:text-4xl font-medium text-gray-900 tracking-wide group-hover:text-rose-700 transition-colors duration-300">
                    Mutesilinda
                </span>
            </a>

            <!-- Menu Button -->
            <button
                @click="isOverlayOpen = !isOverlayOpen"
                :class="isOverlayOpen ? 'text-white bg-black/20 backdrop-blur-sm' : 'text-black hover:bg-black/5'"
                class="fixed top-4 right-4 md:top-6 md:right-6 z-[400] inline-flex items-center justify-center gap-2 md:gap-3 px-3 py-2 md:px-4 rounded-full text-xs sm:text-sm md:text-base tracking-widest uppercase transition-all duration-200 w-24 sm:w-28 md:w-32 min-h-[44px]"
                :aria-label="isOverlayOpen ? 'Close menu' : 'Open menu'"
                :aria-expanded="isOverlayOpen"
            >
                <!-- Label with animated X when open -->
                <span class="relative inline-block w-14 sm:w-16 md:w-20 h-6 md:h-7 text-center">
                    <!-- MENU text -->
                    <span :class="isOverlayOpen ? 'opacity-0 translate-y-1' : 'opacity-100 translate-y-0'" class="block transform transition-all duration-200 ease-out text-xs sm:text-sm md:text-base">Menu</span>
                    <!-- Animated X icon -->
                    <span :class="isOverlayOpen ? 'opacity-100 scale-100' : 'opacity-0 scale-90'" class="absolute inset-0 flex items-center justify-center transform transition-all duration-200 ease-out" aria-hidden="true">
                        <span class="relative block w-6 h-6">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 block h-[2px] w-full bg-current rotate-45 rounded"></span>
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 block h-[2px] w-full bg-current -rotate-45 rounded"></span>
                        </span>
                    </span>
                    <!-- Decorative underlines (only when closed) -->
                    <template x-if="!isOverlayOpen">
                        <div>
                            <span class="pointer-events-none absolute bottom-0 left-1/2 -translate-x-1/2 h-px w-8 bg-black/50"></span>
                            <span class="pointer-events-none absolute -bottom-1 left-1/2 -translate-x-1/2 h-px w-6 bg-black/30"></span>
                        </div>
                    </template>
                </span>
            </button>
        </div>
    </div>

    <!-- Desktop Overlay Menu -->
    <div 
        x-show="isOverlayOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[300]"
        style="display: none;"
    >
        <div class="absolute inset-0 bg-black/60" @click="isOverlayOpen = false"></div>
        <aside
            x-show="isOverlayOpen"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="absolute right-0 top-0 h-full w-full sm:w-4/5 md:w-1/2 lg:w-1/3 bg-[#0b1020] text-white p-6 sm:p-8 flex flex-col transform overflow-y-auto"
        >
            <div class="flex items-center justify-between mb-8 sm:mb-0"></div>
            <!-- Center menu vertically and horizontally -->
            <div class="flex-1 flex items-center justify-center py-8 sm:py-0">
                <nav class="space-y-6 sm:space-y-8 text-center w-full">
                    @foreach($menuItems as $menuItem)
                        @if($menuItem->has_dropdown)
                            <!-- Menu Item with Dropdown (Affiliations) -->
                            <div class="space-y-4">
                                <button
                                    @click="isAffiliationsOpen = !isAffiliationsOpen"
                                    class="group block text-xl sm:text-2xl md:text-3xl lg:text-4xl font-sans uppercase tracking-[0.2em] text-white/90 hover:text-white transition-all duration-200 focus:outline-none outline-none mx-auto min-h-[44px] flex items-center justify-center"
                                >
                                    <span class="relative inline-block">
                                        {{ $menuItem->label }}
                                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-px bg-white/50 transition-all duration-300 group-hover:w-3/4"></span>
                                    </span>
                                </button>

                                <div x-show="isAffiliationsOpen" x-transition class="space-y-3 mt-4 text-center" style="display: none;">
                                    @foreach($affiliations as $affiliation)
                                        <a
                                            href="{{ $affiliation->url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="block text-lg md:text-xl text-white/70 hover:text-white transition-colors"
                                            @click="isOverlayOpen = false"
                                        >
                                            {{ $affiliation->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Regular Menu Item -->
                            <a 
                                href="{{ $menuItem->url }}" 
                                @click="isOverlayOpen = false" 
                                class="group block text-2xl md:text-3xl lg:text-4xl font-sans uppercase tracking-[0.2em] text-white/90 hover:text-white transition-all duration-200"
                                @if($menuItem->is_external) target="_blank" rel="noopener noreferrer" @endif
                            >
                                <span class="relative inline-block">
                                    {{ $menuItem->label }}
                                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-px bg-white/50 transition-all duration-300 group-hover:w-3/4"></span>
                                </span>
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
            <div class="mt-auto pt-12 text-[9px] md:text-[10px] tracking-widest uppercase text-white/60 text-center">
                <span>© {{ date('Y') }} Linda Mutesi</span>
                <span class="mx-3">•</span>
                <a href="/privacy" class="hover:text-white">Privacy Policy</a>
                <span class="mx-3">•</span>
                <a
                    href="https://index.ug"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hover:text-white"
                >
                    Made by Index Digital
                </a>
            </div>
        </aside>
    </div>
</header>
