<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex flex-col items-center justify-center pt-11">
        <h1 class="text-2xl font-bold">Login Account</h1>
        <p class="text-sm mb-10 mt-2">Web Laporan Keuangan Undiknas Denpasar</p>
    </div>

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-auto" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center mt-4">
            <x-primary-button class="w-full flex justify-center h-11">
                {{ __('Sign In') }}
            </x-primary-button>
            <p class="mt-4 text-sm">Dont have Account? <a href="/register" class="underline text-blue-500">Create Account</a></p>
        </div>
    </form>
</x-guest-layout>
