<div class="p-4 min-h-screen border-2 border-gray-200 rounded-3xl  bg-white  md:ml-64 dark:border-gray-700 my-3 mx-2">
    
    <div class="flex-1 p-6">
        @include('layouts.navigation')
        {{ $slot }}
    </div>
</div>