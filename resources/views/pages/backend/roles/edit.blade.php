<x-app-layout>
    <x-sidebar />

    <div class="p-4 border-2 border-gray-200 rounded-lg sm:ml-64 dark:border-gray-700 mt-14">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            
            <section class="bg-white dark:bg-gray-900 rounded-md">
                <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier le rôle</h2>
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            
                            <!-- Champ pour le nom du rôle -->
                            <div class="sm:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du Rôle</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le nom du rôle" required>
                            </div>

                            <!-- Champ pour le guard_name fixé à 'web' -->
                            <div class="sm:col-span-2">
                                <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guard</label>
                                <input type="text" name="guard_name" id="guard_name" value="web" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button type="submit" class="">
                                Mettre à jour le rôle
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </section>
            
        </div>
    </div>
    
</x-app-layout>
