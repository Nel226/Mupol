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
                <!-- Tabs Navigation -->
                <div class="flex mt-4 shadow-md border rounded-md">
                    <button id="tab-all" class="w-1/3 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105 active-tab">Tous</button>
                    <button id="tab-remboursements" class="w-1/3 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105 ">Remboursements</button>
                    <button id="tab-prestations" class="w-1/3 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Prestations </button>
                    <button id="tab-fonctionnement" class="w-1/3 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Fonctionnement</button>
                    <button id="tab-investissements" class="w-1/3 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Investissements</button>

                </div>
                <!-- Tabs Content -->
                <div id="tab-all-content" class="hidden mt-2 tab-content">
                    <div class="">
                     
                    </div>
                    
        
                </div>
                <div id="tab-remboursements-content" class="hidden mt-2 tab-content">
                    <div class="">
                        hh
                    </div>
        
                </div>
                <div id="tab-prestations-content" class="mt-2 tab-content">
                    <div class="">
                        
                    jj
                    </div>
                    
                    
                   
                </div>
                <div id="tab-fonctionnement-content" class="mt-2 tab-content">
                    <div class="">
                        
                    jj
                    </div>
                    
                    
                   
                </div>
                <div id="tab-investissements-content" class="mt-2 tab-content">
                    <div class="">
                        
                    jj
                    </div>
                    
                    
                   
                </div>
                <script>
                    document.getElementById('tab-all').addEventListener('click', function() {
                            showTab('all');
                        });
                    
                        document.getElementById('tab-remboursements').addEventListener('click', function() {
                            showTab('remboursements');
                        });
                        document.getElementById('tab-prestations').addEventListener('click', function() {
                            showTab('prestations');
                        });
                        document.getElementById('tab-fonctionnement').addEventListener('click', function() {
                            showTab('fonctionnement');
                        });
                        document.getElementById('tab-investissements').addEventListener('click', function() {
                            showTab('investissements');
                        });
                        
                        
                        function showTab(tabName) {
                            var tabs = ['all', 'remboursements','prestations', 'fonctionnement', 'investissements'];
                            tabs.forEach(function(tab) {
                                var tabButton = document.getElementById('tab-' + tab);
                                var content = document.getElementById('tab-' + tab + '-content');
                                if (tab === tabName) {
                                    tabButton.classList.add('active-tab');
                                    content.classList.remove('hidden');
                                } else {
                                    tabButton.classList.remove('active-tab');
                                    content.classList.add('hidden');
                                }
                            });
                    
                          
                        }
                   
                    
                    
                </script>
                        
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
