<x-guest-layout>
    <div class="text-center">
        <div class="text-[11px] uppercase tracking-[0.32em] text-gray-500">Account</div>
        <h1 class="mt-3 font-serif text-3xl sm:text-4xl font-medium tracking-[0.02em] leading-[1.05] text-zinc-950">Welcome back</h1>
        <p class="mt-3 text-[15px] leading-relaxed text-gray-700">Sign in to continue reading, borrowing, and saving your place.</p>
    </div>

    <div class="mt-7 h-px bg-gray-200/80"></div>

    <!-- Session Status -->
    <x-auth-session-status class="mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6">
        @csrf

        <input type="hidden" name="redirect" value="{{ request('redirect') }}" />

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[11px] uppercase tracking-[0.28em] text-gray-600" />
            <x-text-input id="email" class="mt-2 block w-full rounded-2xl border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-[11px] uppercase tracking-[0.28em] text-gray-600" />

            <x-text-input id="password" class="mt-2 block w-full rounded-2xl border-gray-200 bg-white px-4 py-3 text-[15px] text-gray-900 shadow-sm focus:border-rose-200 focus:ring-rose-200/60"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-6 flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-gray-700">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-zinc-950 focus:ring-rose-200/60" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-700 hover:text-zinc-950 transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="mt-7 group inline-flex h-12 w-full items-center justify-center rounded-full bg-zinc-950 px-6 text-[12px] uppercase tracking-[0.28em] text-white transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-zinc-900 hover:shadow-lg hover:shadow-gray-900/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-200/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white">
            Log in
            <i class="fa-solid fa-arrow-right text-[11px] ml-2 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
        </button>
    </form>

    <div class="mt-6 text-center">
        <div class="text-sm text-gray-700">
            Don’t have an account?
            <a href="{{ route('register', ['redirect' => request('redirect')]) }}" class="underline underline-offset-4 decoration-gray-300 hover:decoration-gray-400 hover:text-zinc-950 transition-colors">
                Create one
            </a>
        </div>
    </div>
</x-guest-layout>
