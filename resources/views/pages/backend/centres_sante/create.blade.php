<x-app-layout>
    <x-sidebar/>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification-content');
                const closeBtn = document.getElementById('close-notification');
                
                notification.classList.remove('hidden');
                
                closeBtn.addEventListener('click', () => {
                    notification.classList.add('hidden');
                });
            });
        </script>
    @endif

    <x-content-page>
        @section('navigation-content')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" :pageTitle="$pageTitle"/>
        @endsection      

        <div class="flex-1 p-6">
            <x-header>
                {{$pageTitle}}
            </x-header>
            
            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg ">
                <div class="w-3/4 mx-auto">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ajouter une nouvelle dépense</h2>
                
                   
                </div>
                
                        
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
