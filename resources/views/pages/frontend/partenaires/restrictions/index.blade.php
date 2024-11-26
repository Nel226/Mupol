<x-guest-layout>
    <x-header-guest/>

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
    <x-sidebar-guest/>

    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3"
        style="background-image: url('{{ asset('images/background2.jpg') }}'); background-size: cover; background-position: center;">
        <section class="container mx-auto ">
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mx-auto">
                <div class="relative overflow-hidden" style="padding-top: 56.25%; /* Aspect ratio 16:9 */">
                    <iframe 
                        src="{{ asset('pdf/Mupol-restrictions.pdf') }}" 
                        class="absolute top-0 left-0 w-full h-full" 
                        frameborder="0">
                    </iframe>
                </div>
            </div>
            
            
        </section>
    </div>
</x-guest-layout>
