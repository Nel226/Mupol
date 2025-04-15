<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="lg:block z-20 hidden bg-blue-800 w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            <section class="bg-white rounded-md dark:bg-gray-900">
                <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                    <h2 class="mb-4 text-base md:text-xl font-bold text-gray-900 dark:text-white">Créer un nouvel utilisateur</h2>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et Prénom(s)</label>
                                <input type="text" name="name" id="name" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                       placeholder="Saisissez le nom et le prénom" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            <div class="sm:col-span-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Saisissez l'email" required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
                                <input type="password" name="password" id="password" minlength="8"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Saisissez le mot de passe" required>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Liste des conditions pour un bon mot de passe -->
                            <div class="sm:col-span-2 mt-4">
                                <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe doit contenir :</p>
                                <ul id="password-conditions" class="list-disc list-inside text-sm text-gray-600 dark:text-gray-300">
                                    <li id="condition-length" class="text-red-500">Au moins 8 caractères</li>
                                    <li id="condition-uppercase" class="text-red-500">Au moins une lettre majuscule</li>
                                    <li id="condition-lowercase" class="text-red-500">Au moins une lettre minuscule</li>
                                    <li id="condition-number" class="text-red-500">Au moins un chiffre</li>
                                    <li id="condition-special" class="text-red-500">Au moins un caractère spécial (@, $, !, %, *, ?, &amp;)</li>
                                </ul>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Répéter le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" minlength="8"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Répétez le mot de passe" required>
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            
                            
                            <div class="sm:col-span-2">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rôle</label>
                                <select name="role" id="role"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        required>
                                    <option value="">Sélectionnez un rôle</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            
                           
                            
                            <script>
                                const passwordInput = document.getElementById('password');
                                const conditions = {
                                    length: document.getElementById('condition-length'),
                                    uppercase: document.getElementById('condition-uppercase'),
                                    lowercase: document.getElementById('condition-lowercase'),
                                    number: document.getElementById('condition-number'),
                                    special: document.getElementById('condition-special')
                                };
                            
                                passwordInput.addEventListener('input', function() {
                                    const password = passwordInput.value;
                            
                                    // Condition 1: Au moins 8 caractères
                                    if (password.length >= 8) {
                                        conditions.length.classList.remove('text-red-500');
                                        conditions.length.classList.add('text-green-500', 'font-bold');
                                    } else {
                                        conditions.length.classList.remove('text-green-500', 'font-bold');
                                        conditions.length.classList.add('text-red-500');
                                    }
                            
                                    // Condition 2: Au moins une lettre majuscule
                                    if (/[A-Z]/.test(password)) {
                                        conditions.uppercase.classList.remove('text-red-500');
                                        conditions.uppercase.classList.add('text-green-500', 'font-bold');
                                    } else {
                                        conditions.uppercase.classList.remove('text-green-500', 'font-bold');
                                        conditions.uppercase.classList.add('text-red-500');
                                    }
                            
                                    // Condition 3: Au moins une lettre minuscule
                                    if (/[a-z]/.test(password)) {
                                        conditions.lowercase.classList.remove('text-red-500');
                                        conditions.lowercase.classList.add('text-green-500', 'font-bold');
                                    } else {
                                        conditions.lowercase.classList.remove('text-green-500', 'font-bold');
                                        conditions.lowercase.classList.add('text-red-500');
                                    }
                            
                                    // Condition 4: Au moins un chiffre
                                    if (/\d/.test(password)) {
                                        conditions.number.classList.remove('text-red-500');
                                        conditions.number.classList.add('text-green-500', 'font-bold');
                                    } else {
                                        conditions.number.classList.remove('text-green-500', 'font-bold');
                                        conditions.number.classList.add('text-red-500');
                                    }
                            
                                    // Condition 5: Au moins un caractère spécial
                                    if (/[@$!%*?&]/.test(password)) {
                                        conditions.special.classList.remove('text-red-500');
                                        conditions.special.classList.add('text-green-500', 'font-bold');
                                    } else {
                                        conditions.special.classList.remove('text-green-500', 'font-bold');
                                        conditions.special.classList.add('text-red-500');
                                    }
                                });
                            </script>
                            
                            
                        </div>
                        <div class="flex items-end justify-end mt-8">
                            <button class="btn" type="submit">
                                Créer l&apos;utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        
    </x-content-page-admin>
</x-app-layout>
