<x-guest-layout>
    <x-header-guest />

    <div class="min-h-screen flex items-center justify-center pattern-wavy pattern-purple-500 pattern-bg-white 
    pattern-size-16 pattern-opacity-10" style=" background-size: 100% 100%; position: relative;">
        <!-- Container for the purple and white sections -->
        <div class="relative backdrop-blur-sm w-[80%] lg:w-[80%] p-4 mx-auto">
            <div class="mx-auto w-[80%] md:w-[80%] lg:w-[80%]  bg-white p-2 rounded-lg shadow-lg z-10">
                <livewire:wizard-membership />
            </div>
        </div>
    </div>
</x-guest-layout>
