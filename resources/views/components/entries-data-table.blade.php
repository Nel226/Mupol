@props(['id' => 'default-id'])

<div class="flex items-center space-x-2">
    <span>Afficher</span>
    <div class="relative">
        <select id="{{ $id }}" class="block w-full px-3 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-400 focus:outline-none focus:shadow-outline text-sm md:text-base">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <span>éléments</span>
</div>
