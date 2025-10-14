@php
    $socialLinks = [
        [
            'name' => 'Medium',
            'href' => 'https://medium.com/@lindamutesi',
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.54 12a6.8 6.8 0 01-6.77 6.82A6.8 6.8 0 010 12a6.8 6.8 0 016.77-6.82A6.8 6.8 0 0113.54 12zM20.96 12c0 3.54-1.51 6.42-3.38 6.42-1.87 0-3.39-2.88-3.39-6.42s1.52-6.42 3.39-6.42 3.38 2.88 3.38 6.42M24 12c0 3.17-.53 5.75-1.19 5.75-.66 0-1.19-2.58-1.19-5.75s.53-5.75 1.19-5.75C23.47 6.25 24 8.83 24 12z"/></svg>'
        ],
        [
            'name' => 'LinkedIn',
            'href' => 'https://www.linkedin.com/in/linda-mutesi-741ba61bb/',
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>'
        ]
    ];
@endphp

<footer class="bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Follow Linda Section -->
        <div class="py-12 border-b border-gray-800">
            <div class="text-center">
                <h3 class="text-2xl md:text-3xl font-bold mb-8">Follow Linda</h3>
                
                <div class="flex justify-center space-x-6">
                    @foreach($socialLinks as $social)
                        <a
                            href="{{ $social['href'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-3 bg-gray-800 rounded-full hover:bg-amber-600 transition-colors duration-200 group"
                            aria-label="Follow Linda on {{ $social['name'] }}"
                        >
                            <div class="text-gray-300 group-hover:text-white transition-colors">
                                {!! $social['icon'] !!}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="py-8">
            <div class="text-center">
                <p class="text-sm text-gray-400 mb-4">&copy; {{ date('Y') }} Linda Mutesi. All rights reserved.</p>
                <div class="flex justify-center space-x-6">
                    <a href="/privacy" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                    <a href="/terms" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                    <a href="/contact" class="text-gray-400 hover:text-white text-sm transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>
