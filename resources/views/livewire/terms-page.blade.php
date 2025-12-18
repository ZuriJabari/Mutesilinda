<div>
    <x-inner-hero
        kicker="Terms"
        title="Terms of Service"
        subtitle="The rules and conditions for using this website."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Terms'],
        ]"
    />

    <section class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <div class="lg:col-span-4">
                    <div class="lg:sticky lg:top-28">
                        <div class="space-y-3 motion-safe:animate-fadeIn motion-reduce:animate-none" style="animation-delay: 80ms;">
                            <a href="/contact" @click.prevent="$store.contact.open()" class="group inline-flex items-center justify-between w-full rounded-xl border border-zinc-200/80 bg-white px-4 py-3 text-[12px] font-sans font-light uppercase tracking-[0.28em] text-zinc-900 hover:border-zinc-300 transition-colors">
                                <span>Contact</span>
                                <span class="text-zinc-400 group-hover:text-zinc-600 transition-colors">→</span>
                            </a>
                            <a href="/" class="group inline-flex items-center justify-between w-full rounded-xl border border-zinc-200/80 bg-white px-4 py-3 text-[12px] font-sans font-light uppercase tracking-[0.28em] text-zinc-900 hover:border-zinc-300 transition-colors">
                                <span>Back home</span>
                                <span class="text-zinc-400 group-hover:text-zinc-600 transition-colors">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    @if($page)
                        <div class="motion-safe:animate-fadeIn motion-reduce:animate-none" style="animation-delay: 80ms;">
                            <div class="prose prose-zinc max-w-none prose-headings:font-serif prose-headings:tracking-[0.02em] prose-headings:text-zinc-950 prose-h1:mt-0 prose-h1:mb-7 prose-h1:text-4xl sm:prose-h1:text-5xl prose-h1:leading-[0.95] prose-h2:mt-12 prose-h2:mb-5 prose-h2:text-2xl sm:prose-h2:text-3xl prose-h2:leading-tight prose-p:text-[17px] sm:prose-p:text-[18px] md:prose-p:text-[19px] prose-p:leading-[1.85] prose-p:my-6 prose-p:text-zinc-800 prose-ul:my-7 prose-li:my-2 prose-strong:text-zinc-950 prose-a:text-rose-800 prose-a:no-underline hover:prose-a:underline prose-hr:my-12 prose-hr:border-zinc-200/80 prose-blockquote:border-l-zinc-200 prose-img:rounded-2xl">
                                {!! $page->content !!}
                            </div>
                        </div>
                    @else
                        <p class="text-base sm:text-lg leading-relaxed text-zinc-700">Content coming soon. Please check back later or manage this page in the admin panel.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
