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
        
        <div class="flex-1 p-6">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">Gestion des prestations</h1>
            </div>
            
            <div class="p-6 mx-auto mt-4 bg-white rounded-lg shadow-lg ">
                @if ($errors->any())
                    <div class="px-6 py-3 mb-4 bg-red-200 border-red-700 rounded-md alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                        
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
