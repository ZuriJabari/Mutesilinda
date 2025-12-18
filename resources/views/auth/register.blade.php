<x-guest-layout>
    <div class="text-center">
        <div class="text-[11px] uppercase tracking-[0.32em] text-gray-500">Account</div>
        <h1 class="mt-3 font-serif text-3xl sm:text-4xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">Create your account</h1>
        <p class="mt-3 text-[15px] leading-relaxed text-gray-700">Start borrowing from the library and keep up with my latest writing.</p>
    </div>

    <div class="mt-7 h-px bg-gray-200/80"></div>

    <form method="POST" action="{{ route('register') }}" class="mt-6">
        @csrf

        <input type="hidden" name="redirect" value="{{ request('redirect') }}" />

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[11px] uppercase tracking-[0.28em] text-gray-600" />
            <x-text-input id="name" class="mt-2 block w-full rounded-2xl border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="email" :value="__('Email')" class="text-[11px] uppercase tracking-[0.28em] text-gray-600" />
            <x-text-input id="email" class="mt-2 block w-full rounded-2xl border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-[11px] uppercase tracking-[0.28em] text-gray-600" />
            <x-text-input id="password" class="mt-2 block w-full rounded-2xl border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[11px] uppercase tracking-[0.28em] text-gray-600" />
            <x-text-input id="password_confirmation" class="mt-2 block w-full rounded-2xl border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="mt-7 group inline-flex h-12 w-full items-center justify-center rounded-full bg-zinc-950 px-6 text-[12px] uppercase tracking-[0.28em] text-white transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-zinc-900 hover:shadow-lg hover:shadow-gray-900/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white">
            Create account
            <i class="fa-solid fa-arrow-right text-[11px] ml-2 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
        </button>
    </form>

    <div class="mt-6 text-center">
        <div class="text-sm text-gray-700">
            Already have an account?
            <a href="{{ route('login', ['redirect' => request('redirect')]) }}" class="underline underline-offset-4 decoration-gray-300 hover:decoration-gray-400 hover:text-zinc-950 transition-colors">
                Sign in
            </a>
        </div>
    </div>
</x-guest-layout>
