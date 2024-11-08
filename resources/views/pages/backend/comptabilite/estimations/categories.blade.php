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
         
            <div id="categoryGrid" class="relative grid grid-cols-3 gap-6">
                
                @if($categories->isNotEmpty())
                    @foreach ($categories as $categorie)
                        <div class="transform duration-500 hover:scale-105 transition cursor-pointer hover:shadow-lg hover:shadow-gray-400 flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-md">
                            <div class="p-3">
                                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 2xl:col-span-2">
                                    <div class="relative rounded-md px-3 pb-2 pt-3 sm:px-5">
                                        <div class="absolute left-0 top-0 ml-3 mt-3">
                                            <div class="circle">
                                                {{ substr($categorie->nom, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="mx-auto w-36">
                                            <div class="relative block">
                                                <img src="{{ asset('images/folder.png') }}" alt="">
                                            </div>
                                        </div>
                                        <a class="mt-2 block text-sm truncate text-center font-medium" href="#" title="{{ $categorie->nom }}">
                                            {{ $categorie->nom }}
                                        </a>                                        <div class="mt-0.5 text-center text-xs text-slate-500">
                                            {{ $categorie->subcategories_count ?? 'nombre sous-categorie' }} sous-catégories
                                        </div>
                                        
                                        <!-- Dropdown Button -->
                                        <div class="absolute right-0 top-0 ml-auto mr-2 mt-3">
                                            <a href="javascript:;" class="cursor-pointer block">
                                                <div class="relative inline-block text-left">
                                                    <button id="dropdownButton-{{$categorie->id}}" class="inline-flex items-center justify-center text-gray-500 rounded-md focus:outline-none" aria-label="Menu" aria-haspopup="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="12" cy="5" r="1"></circle>
                                                            <circle cx="12" cy="19" r="1"></circle>
                                                        </svg>
                                                    </button>
                                                    <div id="dropdownMenu-{{$categorie->id}}" class="divide-y-2 font-semibold absolute z-10 right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                                                        <a href="#" id="delete-button-{{ $categorie->id }}" class="delete-button flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-300 hover:text-white">
                                                            <i class="fa fa-trash mr-2 w-4"></i> Supprimer
                                                        </a>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                            <i class="fa fa-info mr-2 w-4"></i> Infos
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
            
                                        <!-- Delete Confirmation Modal -->
                                        <x-modal class="!z-50">
                                            <form id="delete-form" action="{{ route('categories.destroy', $categorie) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 bg-danger border-danger text-white dark:border-danger w-24">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </x-modal>
                                        
                                        <!-- Dropdown and Modal Script -->
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var dropdownButton = document.getElementById('dropdownButton-{{$categorie->id}}');
                                                var dropdownMenu = document.getElementById('dropdownMenu-{{$categorie->id}}');
                                                
                                                dropdownButton.addEventListener('click', function () {
                                                    dropdownMenu.classList.toggle('hidden');
                                                });
                                                
                                                document.addEventListener('click', function (event) {
                                                    if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
                                                        dropdownMenu.classList.add('hidden');
                                                    }
                                                });
            
                                                const deleteButtons = document.querySelectorAll('.delete-button');
                                                const deleteForm = document.getElementById('delete-form');
                                                deleteButtons.forEach(button => {
                                                    button.addEventListener('click', function () {
                                                        const categoryId = this.id.replace('delete-button-', '');
                                                        const actionUrl = '{{ route("categories.destroy", ":id") }}'.replace(':id', categoryId);
                                                        deleteForm.action = actionUrl;
                                                        modal.classList.remove('hidden');
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                
                                <!-- Details Button -->
                                <div class="flex flex-col mx-auto items-center">
                                    <div>
                                        <a class="mt-2 block truncate text-center font-medium" href="{{ route('categories.show', $categorie->uuid) }}">
                                           <x-primary-button>
                                               <i class=" fa fa-info-circle mr-1"></i>
                                               Détails
                                           </x-primary-button>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Aucune categorie trouvée.</p>
                @endif
            </div>
            
        </div>
    </x-content-page>
    
</x-app-layout>
