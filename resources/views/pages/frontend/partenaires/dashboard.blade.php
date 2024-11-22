<x-guest-layout class="main-container">
    <style>
        .main-container {
            display: flex;
            flex-direction: row;
            min-height: 100vh; /* Assurez-vous que la page prend toute la hauteur */
        }
    </style>
    <x-header-guest/>
   
        {{--  <x-preloader/>  --}}
        <x-sidebar-guest/>
        <div class=" content">
            <style>
                .content {
                    padding: 1rem;
                }
            </style>
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
