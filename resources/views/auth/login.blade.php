<x-guest-layout>
    <!-- Session Status -->

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username or Email -->
        <div>
            <x-auth-session-status class="mb-1" :status="session('status')" />
            <x-input-error :messages="$errors->get('login')" class="mt-2 mb-2" />
            <x-input-label for="login" :value="__('Username or Email')" />

            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required
                autofocus autocomplete="username" />

        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Create Account-->
        <div class="block mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <span class="font-openSans text-black-light opacity-90 font-medium text-sm tracking-wide ">Don't
                    have an account?
                    <a href="{{ route('register') }}"
                        class="font-openSans text-blue opacity-90 font-medium  tracking-tighter hover:underline ">Create
                        one here
                    </a></span>
            </label>
        </div>

        {{-- Recaptcha --}}
        <div class="mt-2">
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            @error('g-recaptcha-response')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
