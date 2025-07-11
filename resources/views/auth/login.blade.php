<x-guest-layout>
    <div x-data="{ tab: 'teacher' }" class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">

        <!-- Logo & Heading -->
        <div class="flex flex-col items-center justify-center mb-6">
            <img src="{{ asset('images/clglogo.png') }}" alt="logo" class="mb-3" style="height: 60px;">
            <h1 class="text-3xl font-bold text-indigo-700">Login Portal</h1>
        </div>

        <!-- Role Tabs -->
        <div class="flex justify-between mb-6 border-b border-gray-200">
            <button type="button" @click="tab = 'admin'"
                :class="{ 'border-b-2 border-indigo-500 text-indigo-600 font-semibold': tab === 'admin' }"
                class="w-1/3 py-2 text-center hover:bg-gray-100 transition">
                Admin
            </button>

            <button type="button" @click="tab = 'student'"
                :class="{ 'border-b-2 border-indigo-500 text-indigo-600 font-semibold': tab === 'student' }"
                class="w-1/3 py-2 text-center hover:bg-gray-100 transition">
                Student
            </button>

            <button type="button" @click="tab = 'teacher'"
                :class="{ 'border-b-2 border-indigo-500 text-indigo-600 font-semibold': tab === 'teacher' }"
                class="w-1/3 py-2 text-center hover:bg-gray-100 transition">
                Teacher
            </button>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Hidden Role Field -->
            <input type="hidden" name="role" :value="tab">

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email">
                    <span x-show="tab === 'admin'" x-cloak>Admin Email</span>
                    <span x-show="tab === 'student'" x-cloak>Student Email</span>
                    <span x-show="tab === 'teacher'" x-cloak>Teacher Email</span>
                </x-input-label>

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
