<div>

    <!-- Grille pour Matricule et NIP -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4">
        <!-- Matricule -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">Matricule</label>
            <input name="matricule" id="matricule" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                value="{{ old('matricule') }}">
            <span id="matricule-error" class="text-red-500 text-xs"></span>
        </div>

        <!-- NIP -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="nip">NIP</label>
            <input name="nip" id="nip" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                value="{{ old('nip') }}">
            <span id="nip-error" class="text-red-500 text-xs"></span>
        </div>
    </div>
    
</div>