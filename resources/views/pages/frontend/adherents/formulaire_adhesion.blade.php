<x-guest-layout>
    <div style="background-image: url('{{ asset('images/caroussel/caroussel5.jpg') }}'); background-size: cover; background-position: center; height: 100vh;">
        <x-header-guest/>

        <x-section-guest>
            <div class="bg-gray-100 max-w-4xl p-3 mx-auto">

                <livewire:wizard-membership/>
            </div>
        </x-section-guest>
    </div>
</x-guest-layout>