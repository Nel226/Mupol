<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="lg:block z-20 hidden bg-blue-800 w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
        <x-header>
            {{ $pageTitle }}
        </x-header>
        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            @role('communitymanager')
            <div class="dark:bg-gray-100 dark:text-gray-900">
                    <div class="flex flex-wrap items-center justify-end py-2 gap-2">
                        <a href="{{ route('articles.create') }}">
                            <button class="btn">{{ __('Créer un article') }}</button>
                        </a>
                    </div>
                    @foreach ($articles as $article)
                        <div class="container grid grid-cols-12 gap-4 border shadow-md rounded-sm mx-auto my-4 dark:bg-gray-50">
                            <!-- Image Section -->
                            <div class="col-span-full lg:col-span-4">
                                <img 
                                    class="w-full h-auto max-h-fit object-cover rounded-t-sm lg:rounded-none lg:rounded-l-sm dark:bg-gray-300" 
                                    src="{{ asset('storage/' . $article->image_principal) }}" 
                                    alt="{{ $article->titre }}">
                            </div>
                            
                            <!-- Text Content -->
                            <div class="flex flex-col p-4 col-span-full lg:col-span-8 lg:p-8">
                                <!-- Category Tag -->
                                <div class="flex justify-start">
                                    <span class="px-2 py-1 text-xs rounded-full dark:bg-violet-600 bg-primary1 text-white dark:text-gray-50">
                                        {{ $article->categorie }}
                                    </span>
                                </div>
                    
                                <!-- Title -->
                                <h1 class="text-lg font-semibold mt-2">{{ $article->titre }}</h1>
                    
                                <!-- Resume -->
                                <p class="flex-1 text-sm pt-2">{{ $article->resume }}.</p>
                    
                                <!-- 'Voir Plus' Link -->
                                <a rel="noopener noreferrer" href="#" class="inline-flex items-center pt-2 pb-2 space-x-2 text-sm dark:text-violet-600">
                                    <span>Voir plus</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                    
                                <!-- Views Counter -->
                                <div class="flex items-center justify-between pt-2">
                                    <div class="flex space-x-2 items-center">
                                        <i class="fa fa-eye w-5 h-5 dark:text-gray-600"></i>
                                        <span class="self-center text-sm">{{ $article->views }} vues</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                
                </div>
            @endrole
        </div>

    </x-content-page-admin>
</x-app-layout>

