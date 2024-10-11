<x-guest-layout>
    <div  class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-900" style="background: linear-gradient(15deg, white 50%, rgb(227, 226, 227) 50.1%);">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>
    
        <div class="w-full sm:max-w-md mt-6   bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <div class="bg-gray-100 border-[#4000FF] border-2 py-3 px-8 rounded-lg shadow-xl">
                <div class="text-center justify-center flex mb-8">
                    
                    <h1 class="text-2xl font-bold text-center mt-4">Connexion</h1>
                </div>
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
                        <div class="flex justify-between">
            
                            <x-input-label for="password" :value="__('Mot de passe')" />
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
            
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class=" my-4 w-full mx-auto">
                
                                <x-primary-button class="!justify-center !py-3 !w-full">
                                    {{ __('Se connecter') }}
                                </x-primary-button>
                            </div>
                    </div>
                    <!-- Remember Me -->
                    {{--  <div class="text-center mt-4 justify-center">
                        <span class="ms-2 text-sm justify-center text-gray-600 dark:text-gray-400">
                            Vous n&apos;avez pas encore de compte? 
                            <a class="text-blue-700 underline justify-center" href=" {{ route('register') }}">S&apos;incrire</a>
                        </span>
                        
                    </div>  --}}
            
                    {{--  <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        @endif
            
                        <x-primary-button class="ms-3">
                            {{ __('Se connecter') }}
                        </x-primary-button>
                    </div>  --}}
                </form>
            </div>
    
        </div>
    </div>
</x-guest-layout>


