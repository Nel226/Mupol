<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-900" style="background: linear-gradient(15deg, white 50%, rgb(227, 226, 227) 50.1%);">
        <div class="w-[15%] sm:w-[25%] md:w-[20%] lg:w-[10%]">
            <a href="/">
                <x-application-logo class="fill-current text-gray-500" />
            </a>
        </div>
    
        <div class="w-full sm:max-w-md mt-6 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <div class="bg-gray-100 w-[80%] mx-auto border-primary1 border-2 py-3 px-8 rounded-lg shadow-xl">
                <div class="text-center justify-center flex mb-8">
                    <h1 class="text-xl sm:text-2xl font-bold text-center mt-4">Connexion</h1> <!-- Adjusted text size for small screens -->
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
            
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm sm:text-base" /> <!-- Adjusted text size -->
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <x-input-label for="password" :value="__('Mot de passe')" class="text-sm sm:text-base" /> <!-- Adjusted text size -->
                            @if (Route::has('password.request'))
                                <a class="underline text-xs sm:text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <!-- Login Button -->
                    <div class="my-4 w-full mx-auto">
                        <button class="btn w-full">
                            {{ __('Se connecter') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
