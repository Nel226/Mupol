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
                    <div class="container grid grid-cols-12 border shadow-md rounded-sm mx-auto dark:bg-gray-50">
                        <div class="bg-no-repeat bg-cover dark:bg-gray-300 col-span-full lg:col-span-4" style="background-image: url('https://source.unsplash.com/random/640x480'); background-position: center center; background-blend-mode: multiply; background-size: cover;"></div>
                        <div class="flex flex-col p-4 col-span-full row-span-full lg:col-span-8 lg:p-8">
                            <div class="flex justify-start">
                                <span class="px-2 py-1 text-xs rounded-full dark:bg-violet-600 bg-primary1 text-white dark:text-gray-50">Label</span>
                            </div>
                            <h1 class="text-lg font-semibold">Lorem ipsum dolor sit.</h1>
                            <p class="flex-1 text-sm pt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, reprehenderit adipisci tempore voluptas laborum quod.</p>
                            <a rel="noopener noreferrer" href="#" class="inline-flex items-center pt-2 pb-2 space-x-2 text-sm dark:text-violet-600">
                                <span>Read more</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <div class="flex items-center justify-between pt-2">
                                <div class="flex space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 dark:text-gray-600">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="self-center text-sm">by Leroy Jenkins</span>
                                </div>
                                <span class="text-xs">3 min read</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>

    </x-content-page-admin>
</x-app-layout>

