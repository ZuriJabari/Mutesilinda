<div>
    {{-- Hero Section --}}
    <x-inner-hero
        kicker="Thinking About"
        title="Personal Reflections & Stories"
        subtitle="This blog is where I bring these journeys together. Here, you'll find personal reflections on my work as a lawyer, philanthropy student, and community collaborator; behind-the-scenes insights into the projects I am part of; and conversations with fellow creatives who are making a difference in their fields. At its core, this space is about storytelling—the kind that uplifts, challenges, and connects us."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Blog'],
        ]"
    />

    {{-- Blog Posts Section --}}
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($posts->count() > 0)
                <div class="mb-12 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-black mb-4">Latest Stories</h2>
                    <p class="text-gray-600 text-lg">Insights on leadership, philanthropy, and social impact</p>
                </div>
                
                {{-- Posts Grid --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 group">
                            <a href="/blog/{{ $post->slug }}" class="block">
                                @if($post->featured_image)
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />
                                @else
                                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                        <span class="text-gray-400 text-4xl">📝</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-6">
                                @if($post->published_at)
                                    <time class="text-xs uppercase tracking-wider text-gray-500">{{ $post->published_at->format('F j, Y') }}</time>
                                @endif
                                <h3 class="mt-2 text-xl font-bold text-black leading-tight">
                                    <a href="/blog/{{ $post->slug }}" class="hover:underline">{{ $post->title }}</a>
                                </h3>
                                @if($post->subtitle)
                                    <p class="mt-2 text-gray-600">{{ $post->subtitle }}</p>
                                @endif
                                @if($post->excerpt)
                                    <p class="mt-3 text-gray-700 leading-relaxed line-clamp-3">{{ $post->excerpt }}</p>
                                @endif
                                <div class="mt-4">
                                    <a href="/blog/{{ $post->slug }}" class="inline-flex items-center gap-2 text-black font-semibold hover:underline">
                                        Read More
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">📝</div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No posts yet</h2>
                    <p class="text-gray-600">Check back soon for new stories and reflections.</p>
                </div>
            @endif
        </div>
    </section>
</div>
