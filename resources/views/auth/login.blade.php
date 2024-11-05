<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
            <x-input-label for="password" :value="__('Senha')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" 
                              type="password" 
                              name="password" 
                              required autocomplete="current-password" />
            </div>
            <div class="flex justify-end mt-1">
                <label for="togglePassword" class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" id="togglePasswordCheckbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mr-2" onclick="togglePasswordVisibility()">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Mostrar senha') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="ms-1 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Esqueci a senha') }}
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn ms-4 text-white" style="background-color: #4CAF50; padding: 5px 15px; border-radius: 20px; font-size: 14px; text-decoration: none;">
                    {{ __('Crie sua conta') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const passwordInput = document.getElementById('password');

        function togglePasswordVisibility() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>
</x-guest-layout>
