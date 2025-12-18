<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-inner-hero
        kicker="Research"
        title="Research Interests"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Research'],
        ]"
    />

    <section class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($page)
                <div class="prose prose-zinc max-w-none prose-headings:font-serif prose-headings:tracking-[0.02em] prose-headings:text-zinc-950 prose-h1:text-3xl sm:prose-h1:text-4xl prose-h1:leading-[1.05] prose-h2:text-2xl sm:prose-h2:text-3xl prose-h2:leading-tight prose-p:text-[17px] sm:prose-p:text-[18px] prose-p:leading-[1.85] prose-p:text-zinc-800 prose-strong:text-zinc-950 prose-a:text-rose-800 prose-a:no-underline hover:prose-a:underline prose-img:rounded-2xl">
                    {!! $page->content !!}
                </div>
            @else
                <p class="text-xl text-gray-700">Content coming soon. Please check back later or manage this page in the admin panel.</p>
            @endif
        </div>
    </section>
</div>
