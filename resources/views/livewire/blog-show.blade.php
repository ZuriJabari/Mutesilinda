<div>
    {{-- Success is as dangerous as failure. --}}
    <div>
        {{-- Article Header --}}
        <article class="bg-white">
            <header class="bg-gradient-to-br from-gray-50 to-gray-100 pt-24 md:pt-32 pb-12">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="text-sm text-gray-500 mb-8">
                        <a href="/" class="hover:text-black transition-colors">Home</a>
                        <span class="mx-2">/</span>
                        <a href="/blog" class="hover:text-black transition-colors">Blog</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900 font-medium">{{ $post->title }}</span>
                    </nav>

                    @if($post->published_at)
                        <time class="text-sm uppercase tracking-wider text-gray-500">{{ $post->published_at->format('F j, Y') }}</time>
                    @endif
                    
                    <h1 class="mt-4 text-4xl md:text-5xl lg:text-6xl font-bold text-black leading-tight">
                        {{ $post->title }}
                    </h1>
                    
                    @if($post->subtitle)
                        <p class="mt-6 text-xl md:text-2xl text-gray-700 leading-relaxed">
                            {{ $post->subtitle }}
                        </p>
                    @endif
                </div>
            </header>

            @if($post->featured_image)
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow-2xl" />
                </div>
            @endif

            {{-- Article Content --}}
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="prose prose-lg prose-headings:font-bold prose-a:text-rose-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-lg max-w-none">
                    {!! $post->content !!}
                </div>
            </div>

            {{-- Related Posts --}}
            @if($relatedPosts->count() > 0)
                <div class="bg-gray-50 py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold text-black mb-8">More Stories</h2>
                        <div class="grid md:grid-cols-3 gap-8">
                            @foreach($relatedPosts as $related)
                                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 transition-all duration-300">
                                    <a href="/blog/{{ $related->slug }}">
                                        @if($related->featured_image)
                                            <img src="{{ $related->featured_image }}" alt="{{ $related->title }}" class="w-full h-48 object-cover" />
                                        @else
                                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                                <span class="text-4xl">📝</span>
                                            </div>
                                        @endif
                                        <div class="p-6">
                                            <h3 class="text-xl font-bold text-black hover:underline">{{ $related->title }}</h3>
                                            @if($related->subtitle)
                                                <p class="mt-2 text-gray-600 line-clamp-2">{{ $related->subtitle }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </article>
    </div>
</div>
