<div x-data="{ open: @entangle($attributes->wire('model')).defer }" x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50" style="display: none;">
    <div class="bg-white text-sm rounded-md shadow-md p-6 relative w-[90%] sm:w-[460px]">
        <div class="p-3 text-center">
            <i class="{{ $icon }}  mx-auto" style="font-size:48px;"></i>
            <div class="mt-5 text-2xl">{{ $title }}</div>
            <div class="mt-2 text-slate-500">
                {{ $slot }}
            </div>
        </div>
        <div class="flex items-center mx-auto space-x-4 justify-center px-5 pb-8 text-center">
            <div>
                <x-primary-button @click="open = false" class=" bg-slate-500">
                    Annuler
                </x-primary-button>
            </div>
            <div>
                {{ $actions ?? '' }}
            </div>
        </div>
        <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>
