@props([
    'kicker' => null,
    'title' => null,
    'subtitle' => null,
    'breadcrumbs' => [],
])

<section class="relative overflow-hidden border-b border-gray-200/70 bg-[#fbfaf9] pt-24 md:pt-32 pb-14">
    <div class="pointer-events-none absolute -top-40 -right-40 h-[32rem] w-[32rem] rounded-full bg-rose-200/30 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-56 -left-40 h-[36rem] w-[36rem] rounded-full bg-zinc-200/40 blur-3xl"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($breadcrumbs))
            <nav aria-label="Breadcrumb" class="text-[11px] uppercase tracking-[0.28em] text-gray-500">
                <ol class="flex flex-wrap items-center gap-2">
                    @foreach($breadcrumbs as $index => $crumb)
                        @if($index > 0)
                            <li class="text-gray-400">/</li>
                        @endif
                        <li>
                            @if(!empty($crumb['url']))
                                <a href="{{ $crumb['url'] }}" class="hover:text-zinc-950 transition-colors">{{ $crumb['label'] }}</a>
                            @else
                                <span class="text-zinc-950">{{ $crumb['label'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if(!empty($kicker))
            <div class="mt-8 text-[12px] uppercase tracking-[0.3em] text-gray-500">{{ $kicker }}</div>
        @endif

        @isset($meta)
            {!! $meta !!}
        @endisset

        @if(!empty($title))
            <h1 class="mt-4 font-serif text-4xl sm:text-5xl lg:text-6xl font-medium tracking-[0.02em] leading-[0.98] text-zinc-950">
                {{ $title }}
            </h1>
        @endif

        @if(!empty($subtitle))
            <p class="mt-6 text-xl md:text-2xl text-gray-700 leading-relaxed max-w-3xl">
                {{ $subtitle }}
            </p>
        @endif

        {{ $slot }}
    </div>
</section>
