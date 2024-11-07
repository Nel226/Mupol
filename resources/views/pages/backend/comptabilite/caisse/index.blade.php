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
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-3  border-gray-300 divide-y divide-gray-300 lg:divide-y-0 lg:divide-x">
                    @foreach($adherentsCountPerRegion as $region => $count)
                        <div class="flex items-center p-4 bg-white border shadow-lg">
                            <div class="w-10 h-10 p-3 mr-4 text-[#4000FF] bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fa fa-bank"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-base font-medium text-gray-600">
                                    {{ $region }}
                                </p>
                                <p class="text-xs font-semibold text-gray-700">
                                    {{ $count }} adhérents
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                       
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
