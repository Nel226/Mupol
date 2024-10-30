<x-app-layout>
    <x-sidebar />

    <x-content-page>

        <div class="flex-1 p-6">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">{{$pageTitle}}</h1>
            </div>
            
            
            <div class="p-6 mx-auto mt-4 bg-white rounded-lg shadow-lg ">
                <section class="bg-white dark:bg-gray-900">
                    <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier une demande</h2>
                        @livewire('edit-membership', ['demandeAdhesionId' => $demande->id]) <!-- Passer le paramètre -->
                    </div>
                </section>
                
            </div>
        </div>
    </x-content-page>

    
</x-app-layout>
