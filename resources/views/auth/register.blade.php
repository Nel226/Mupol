<x-guest-layout>
    <div class="bg-gray-100 border-primary1 border-2 py-3 px-8 rounded-lg shadow-lg">
        <div class="text-center justify-center flex mb-8"> 
            <h1 class="text-2xl font-bold text-center mt-4">Inscription</h1>
           
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
    
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <div class=" mt-4 w-full mx-auto">
        
                        <x-primary-button class="!justify-center !py-3 !w-full">
                        {{ __('S inscrire') }}
            
                        </x-primary-button>
                       
                    </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                
                <div class="text-center  mx-auto justify-center">
                    <span class="ms-2 text-sm mx-auto justify-center text-gray-600 dark:text-gray-400">
                        {{ __('Vous avez déjà un compte ?') }}
                        <a class="text-blue-700 underline justify-center" href=" {{ route('register') }}">Se connecter</a>
                    </span>
                    
                </div>
               
            </div>
        </form>
        
    </div>
</x-guest-layout>
