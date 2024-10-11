@props(['title'])

<div class="h-full rounded-lg shadow-lg overflow-hidden border border-gray-300">
    <!-- Header -->
    <div class="bg-[#fffe4a70] text-gray-800 px-6 py-3">
        <h2 class="text-lg font-semibold">{{ $title }}</h2>
    </div>

    <!-- Content -->
    <div class="p-6 text-base bg-white">
        {{ $slot }}
    </div>
</div>
