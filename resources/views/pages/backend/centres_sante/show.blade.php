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
            
            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg">
                <div class="flex space-x-4">
                    <a href="{{ route('centres-sante.edit', $centre) }}" >
                        <x-primary-button>
                            Modifier
                        </x-primary-button>
                    </a>
            
                    <!-- Bouton Supprimer -->
                    <form action="{{ route('centres-sante.destroy', $centre->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce centre de santé ?');">
                        @csrf
                        @method('DELETE')
                        <x-primary-button type="submit" class=" bg-red-600  hover:bg-red-700">
                            Supprimer
                        </x-primary-button>
                    </form>
                </div>
            </div>
            
        </div>
    </x-content-page>
    
</x-app-layout>
