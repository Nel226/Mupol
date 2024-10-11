<x-app-layout>
    <x-sidebar />

    <div class="p-4 border-2 border-gray-200 rounded-lg sm:ml-64 dark:border-gray-700 mt-14">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            
            <section class="bg-white rounded-md dark:bg-gray-900">
                <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un nouvel utilisateur</h2>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Saisissez le nom" required>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Saisissez l'email" required>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
                                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Saisissez le mot de passe" required>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Répéter le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Répétez le mot de passe" required>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rôle</label>
                                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="">Sélectionnez un rôle</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-end justify-end mt-8">
                            <x-primary-button type="submit">
                                Créer l&apos;utilisateur
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>

</x-app-layout>
