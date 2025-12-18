@php
    use App\Models\MenuItem;
    use App\Models\Affiliation;
    
    $menuItems = MenuItem::where('is_active', true)->orderBy('order')->get();
    $affiliations = Affiliation::where('is_active', true)->orderBy('order')->get();
@endphp

<header x-data="{ 
    isOverlayOpen: false,
    isAffiliationsOpen: false,
    isHidden: false,
    lastScrollY: 0,
    init() {
        this.lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const currentY = window.scrollY;
            const delta = currentY - this.lastScrollY;

            if (this.isOverlayOpen) {
                this.isHidden = false;
                this.lastScrollY = currentY;
                return;
            }

            if (currentY < 20) {
                this.isHidden = false;
            } else if (delta > 8 && currentY > 80) {
                this.isHidden = true;
            } else if (delta < -8) {
                this.isHidden = false;
            }

            this.lastScrollY = currentY;
        }, { passive: true });
    }
}" 
:class="(isHidden && !isOverlayOpen) ? '-top-24' : 'top-0'" 
class="fixed left-0 right-0 z-[100] bg-transparent transition-[top] duration-500 ease-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo - Luxurious & Elegant -->
            <a href="/" class="flex-shrink-0 select-none py-2 group relative" aria-label="Mutesilinda.com Home">
                <div class="relative">
                    <!-- Main Logo Text -->
                    <span class="block font-sans text-[22px] sm:text-[26px] md:text-[30px] font-medium text-zinc-950 tracking-[0.14em] leading-none transition-colors duration-500 group-hover:text-rose-800">
                        Mutesilinda<span class="text-rose-700 group-hover:text-rose-800 transition-colors duration-500">•</span>
                    </span>
                    <div class="mt-1 flex items-center gap-2 justify-start">
                        <span class="h-px w-10 bg-rose-500/25"></span>
                        <span class="text-[9px] sm:text-[10px] font-sans tracking-[0.26em] uppercase text-zinc-500 group-hover:text-rose-700 transition-colors duration-500">.com</span>
                        <span class="h-px w-10 bg-rose-500/25"></span>
                    </div>
                </div>
            </a>

            <!-- Menu Button -->
            <button
                @click="isOverlayOpen = !isOverlayOpen"
                :class="isOverlayOpen ? 'text-white bg-transparent border-transparent hover:bg-white/10' : 'text-zinc-950 bg-transparent border-transparent hover:bg-black/5'"
                class="fixed top-4 right-4 md:top-6 md:right-6 z-[400] inline-flex items-center justify-center gap-2 md:gap-3 px-3 py-2 md:px-4 rounded-full border text-xs sm:text-sm md:text-base tracking-[0.18em] uppercase transition-all duration-200 w-24 sm:w-28 md:w-32 min-h-[44px]"
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
                <nav class="space-y-7 sm:space-y-10 text-center w-full">
                    @foreach($menuItems as $menuItem)
                        @if($menuItem->has_dropdown)
                            <!-- Menu Item with Dropdown (Affiliations) -->
                            <div class="space-y-4">
                                <button
                                    @click="isAffiliationsOpen = !isAffiliationsOpen"
                                    class="group block text-xl sm:text-2xl md:text-3xl font-sans font-light uppercase tracking-[0.18em] leading-[1.05] text-white/90 hover:text-white transition-all duration-200 focus:outline-none outline-none mx-auto min-h-[44px] flex items-center justify-center"
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
                                            class="block text-[11px] sm:text-xs md:text-sm font-sans font-light uppercase tracking-[0.18em] leading-relaxed text-white/70 hover:text-white transition-colors"
                                            @click="isOverlayOpen = false"
                                        >
                                            {{ $affiliation->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Regular Menu Item -->
                            @if($menuItem->url === '/contact')
                                <a
                                    href="{{ $menuItem->url }}"
                                    @click.prevent="$store.contact.open(); isOverlayOpen = false"
                                    class="group block text-xl sm:text-2xl md:text-3xl font-sans font-light uppercase tracking-[0.18em] leading-[1.05] text-white/90 hover:text-white transition-all duration-200"
                                >
                                    <span class="relative inline-block">
                                        {{ $menuItem->label }}
                                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-px bg-white/50 transition-all duration-300 group-hover:w-3/4"></span>
                                    </span>
                                </a>
                            @else
                                <a 
                                    href="{{ $menuItem->url }}" 
                                    @click="isOverlayOpen = false" 
                                    class="group block text-xl sm:text-2xl md:text-3xl font-sans font-light uppercase tracking-[0.18em] leading-[1.05] text-white/90 hover:text-white transition-all duration-200"
                                    @if($menuItem->is_external) target="_blank" rel="noopener noreferrer" @endif
                                >
                                    <span class="relative inline-block">
                                        {{ $menuItem->label }}
                                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-px bg-white/50 transition-all duration-300 group-hover:w-3/4"></span>
                                    </span>
                                </a>
                            @endif
                        @endif
                    @endforeach
                </nav>
            </div>
            <div class="mt-auto pt-12 text-[11px] md:text-[12px] tracking-[0.18em] uppercase text-white/60 text-center">
                <div class="flex flex-wrap items-center justify-center gap-x-3 gap-y-2">
                    <span>© {{ date('Y') }} Linda Mutesi</span>
                    <span aria-hidden="true">•</span>
                    <a href="/privacy" class="hover:text-white">Privacy Policy</a>
                </div>

                <div class="mt-3">
                    <a
                        href="https://index.ug"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="hover:text-white"
                    >
                        Made by Index Digital
                    </a>
                </div>
            </div>
        </aside>
    </div>
</header>
