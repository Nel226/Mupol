<x-guest-layout>
    <x-header-guest/>
    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                
                setTimeout(() => {
                    notification.classList.add('hidden'); // Cache le message après 5 secondes
                }, 5000);
            });
        </script>
    @endif

    {{--  <x-preloader/>  --}}
    <x-sidebar-guest/>
    <div class="">
        <section class="section">
            <div class="container h-screen">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
