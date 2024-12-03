@props(['id' => 'default-id'])

<div class="relative text-xs mt-2 w-full sm:w-auto">
    <input 
        type="text" 
        id="{{ $id }}" 
        class="block w-full sm:w-80 px-6 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
        placeholder="Rechercher">
    <div class="absolute inset-y-0 left-0 flex items-center ps-3">
        <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
        </svg>
    </div>
</div>
