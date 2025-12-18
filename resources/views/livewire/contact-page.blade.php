<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-inner-hero
        kicker="Contact"
        title="Get in Touch"
        subtitle="I'd love to hear from you. Send me a message and I'll get back to you as soon as possible."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Contact'],
        ]"
    />

    <section class="bg-white py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($success)
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                    <p class="text-green-800 font-medium">Thank you for your message! I'll get back to you soon.</p>
                </div>
            @endif

            <form wire:submit.prevent="submit" class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input 
                        type="text" 
                        id="name" 
                        wire:model="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500"
                        required
                    />
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input 
                        type="email" 
                        id="email" 
                        wire:model="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500"
                        required
                    />
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                    <textarea 
                        id="message" 
                        wire:model="message"
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500"
                        required
                    ></textarea>
                    @error('message') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full bg-rose-700 text-white font-semibold py-4 rounded-full hover:bg-rose-800 transition-all duration-300"
                >
                    Send Message
                </button>
            </form>

            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-4">Or reach me directly at:</p>
                <a href="mailto:linda@mutesilinda.com" class="text-rose-600 font-semibold text-lg hover:underline">
                    linda@mutesilinda.com
                </a>
            </div>
        </div>
    </section>
</div>
