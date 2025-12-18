<div
    x-cloak
    x-show="$store.contact.isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[250]"
    @keydown.escape.window="$store.contact.close(); $wire.resetForm()"
>
    <div class="absolute inset-0 bg-black/55" @click="$store.contact.close(); $wire.resetForm()"></div>

    <div class="absolute inset-0 flex items-center justify-center px-4 sm:px-6">
        <div
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4 scale-[0.98]"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-3 scale-[0.98]"
            class="w-full max-w-xl rounded-3xl border border-gray-200/70 bg-white p-7 sm:p-8 shadow-2xl shadow-gray-900/25"
            @click.stop
        >
            <div class="flex items-start justify-between gap-6">
                <div>
                    <div class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Contact</div>
                    <h2 class="mt-3 font-serif text-3xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">Get in Touch</h2>
                    <p class="mt-3 text-[15px] leading-relaxed text-gray-700">Send a message and I’ll get back to you as soon as possible.</p>
                </div>

                <button
                    type="button"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-700 transition-colors hover:bg-gray-50 hover:text-zinc-950"
                    @click="$store.contact.close(); $wire.resetForm()"
                    aria-label="Close"
                >
                    <i class="fa-solid fa-xmark text-[16px]" aria-hidden="true"></i>
                </button>
            </div>

            <div class="mt-6">
                @if($success)
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">
                        <div class="text-[11px] uppercase tracking-[0.28em] text-emerald-800">Sent</div>
                        <div class="mt-2 text-emerald-900">Thank you for your message. I’ll get back to you soon.</div>
                        <div class="mt-4">
                            <button
                                type="button"
                                class="inline-flex h-11 items-center justify-center rounded-full bg-zinc-950 px-6 text-[12px] uppercase tracking-[0.28em] text-white transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-zinc-900 hover:shadow-lg hover:shadow-gray-900/15"
                                @click="$store.contact.close(); $wire.resetForm()"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                @else
                    <form wire:submit.prevent="submit" class="space-y-5">
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label class="text-[11px] uppercase tracking-[0.28em] text-gray-600" for="contact_name">Name</label>
                                <input id="contact_name" type="text" wire:model.defer="name" class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60" required />
                                @error('name')
                                    <div class="mt-2 text-sm text-rose-700">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="text-[11px] uppercase tracking-[0.28em] text-gray-600" for="contact_email">Email</label>
                                <input id="contact_email" type="email" wire:model.defer="email" class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60" required />
                                @error('email')
                                    <div class="mt-2 text-sm text-rose-700">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="text-[11px] uppercase tracking-[0.28em] text-gray-600" for="contact_message">Message</label>
                            <textarea id="contact_message" rows="6" wire:model.defer="message" class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60" required></textarea>
                            @error('message')
                                <div class="mt-2 text-sm text-rose-700">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
                            <a href="mailto:linda@mutesilinda.com" class="text-[12px] uppercase tracking-[0.28em] text-gray-700 hover:text-zinc-950 transition-colors">linda@mutesilinda.com</a>

                            <button type="submit" wire:loading.attr="disabled" class="group inline-flex h-11 items-center justify-center rounded-full bg-zinc-950 px-6 text-[12px] uppercase tracking-[0.28em] text-white transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-zinc-900 hover:shadow-lg hover:shadow-gray-900/15 disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:translate-y-0">
                                <span wire:loading.remove>Send message</span>
                                <span wire:loading>Sending…</span>
                                <i class="fa-solid fa-arrow-right text-[11px] ml-2 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
