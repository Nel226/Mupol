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
                    <h2 class="mb-4 text-base md:text-xl font-bold text-gray-900 dark:text-white">Créer un nouveau rôle</h2>
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du rôle</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Saisissez le nom du rôle" required>
                            </div>
                            <div class="sm:col-span-2">
                              
                                <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guard name</label>
                                <input type="text" name="guard_name" id="guard_name" value="web" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly required>
                                
                            </div>
                        </div>
                        <div class="flex items-end justify-end mt-8">
                            <button class="btn" type="submit">
                                Ajouter le Rôle
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        
    </x-content-page-admin>
</x-app-layout>
