<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <section class="bg-gradient-to-br from-gray-50 to-gray-100 pt-24 md:pt-32 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-black mb-8">Research Interests</h1>
            @if($page)
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($page->content)) !!}
                </div>
            @else
                <p class="text-xl text-gray-700">Content coming soon. Please check back later or manage this page in the admin panel.</p>
            @endif
        </div>
    </section>
</div>
