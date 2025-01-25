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

    <!-- Grille pour N° CNIB, Délivré le, et Expire le -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 mt-3">
        <!-- N° CNIB -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="cnib">N° CNIB</label>
            <input required name="cnib" id="cnib" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                value="{{ old('cnib') }}">
            <span id="cnib-error" class="text-red-500 text-xs"></span>
        </div>

        <!-- Délivré le -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="delivree">Délivré le</label>
            <input required name="delivree" id="delivree" type="date"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
            <span id="delivree-error" class="text-red-500 text-xs"></span>
        </div>

        <!-- Expire le -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="expire">Expire le</label>
            <input name="expire" id="expire" type="date"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                readonly value="{{ old('expire') }}">
            <span id="expire-error" class="text-red-500 text-xs"></span>
        </div>

        <!-- Adresse permanente -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="adresse_permanente">Adresse permanente</label>
            <input name="adresse_permanente" id="adresse_permanente" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                value="{{ old('adresse_permanente') }}">
            <span id="error-adresse_permanente" class="text-red-500 text-xs"></span>
        </div>

        <!-- Téléphone -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone">Téléphone</label>
            <input name="telephone" id="telephone" type="tel" placeholder="Ex: 77112233"
                title="Ex. (numéro valide) : +22677020202 ou 77020202"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                value="{{ old('telephone') }}">
            <span id="error-telephone" class="text-red-500 text-xs"></span>
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="email">Email</label>
            <input name="email" id="email" type="email"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                value="{{ old('email') }}">
            <span id="error-email" class="text-red-500 text-xs"></span>
        </div>
    </div>
</div>


<script>
    // Calcul de l'année d'expiration de la CNIB
    document.addEventListener('DOMContentLoaded', () => {
        // Gestion de la date d'expiration
        document.getElementById('delivree').addEventListener('change', (e) => {
            const delivree = e.target.value; // Récupère la date de délivrance
            if (delivree) {
                const expire = new Date(delivree); // Convertit en objet Date
                expire.setFullYear(expire.getFullYear() + 10); // Ajoute 10 ans
                const expireFormatted = expire.toISOString().split('T')[0]; // Formate la date
                document.getElementById('expire').value = expireFormatted; // Met à jour le champ "expire"
            }
        });
    });

</script>
