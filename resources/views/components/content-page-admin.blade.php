
<div class="p-2">

    <div class="lg:ml-64 px-4 sm:px-6 lg:px-6 py-8 min-h-screen bg-gray-100 rounded-lg">
        <div class="flex-1 lg:p-6 lg:py-0 py-4">
            @include('layouts.navigation')
            {{ $slot }}
        </div>
    </div>
    
</div>