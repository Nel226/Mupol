
<div>
    <!-- Grille pour Nom(s), Prénom(s), et Genre -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Nom(s) -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="nom">Nom</label>
            <input required name="nom" id="nom" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
            <span id="error-nom" class="text-red-500 text-xs"></span>
        </div>

        <!-- Prénom(s) -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="prenom">Prénom(s)</label>
            <input required name="prenom" id="prenom" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
            <span id="error-prenom" class="text-red-500 text-xs"></span>
        </div>

        <!-- Genre (Radio buttons) -->
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
            <div class="flex items-center mb-4">
                <input  name="genre" id="masculin" type="radio" value="M" class="mr-2">
                <label for="masculin" class="mr-6">Masculin</label>

                <input  name="genre" id="feminin" type="radio" value="F" class="mr-2">
                <label for="feminin">Féminin</label>
            </div>
            <span id="error-genre" class="text-red-500 text-xs"></span>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const genreChecked = document.querySelector('input[name="genre"]:checked');
                
                if (genreChecked) {
                    console.log("Une valeur est sélectionnée par défaut : ", genreChecked.value);
                } else {
                    console.log("Aucune valeur sélectionnée par défaut.");
                }
            });
            
        </script>

    </div>

    <!-- Lieu de naissance -->
    <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
        <legend class="block text-gray-700 text-sm font-bold mb-2">Lieu de naissance</legend>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Département -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1" for="departement">Département</label>
                <input required name="departement" id="departement" type="text"
                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                <span id="error-departement" class="text-red-500 text-xs"></span>
            </div>

            <!-- Ville / Village -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1" for="ville">Ville / Village</label>
                <input required name="ville" id="ville" type="text"
                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                <span id="error-ville" class="text-red-500 text-xs"></span>
            </div>

            <!-- Pays -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1" for="pays">Pays</label>
                <input required name="pays" id="pays" type="text"
                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                <span id="error-pays" class="text-red-500 text-xs"></span>
            </div>
        </div>
    </fieldset>

    <!-- Grille pour Nom et Prénom(s) du père et de la mère -->
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_pere">Nom et Prénom(s) du père</label>
            <input required name="nom_pere" id="nom_pere" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
            <span id="error-nom-pere" class="text-red-500 text-xs"></span>
        </div>

        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_mere">Nom et Prénom(s) de la mère</label>
            <input required name="nom_mere" id="nom_mere" type="text"
                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
            <span id="error-nom-mere" class="text-red-500 text-xs"></span>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const step2 = document.getElementById("step-2");

        // Example: Show Step 2 (replace with your logic)
        const currentStep = 2; // Replace this with your logic for the current step
        if (currentStep === 2) {
            step2.style.display = "block";
        }

        // Handle form data
        const formData = {
            nom: "",
            prenom: "",
            genre: "",
            departement: "",
            ville: "",
            pays: "",
            nom_pere: "",
            nom_mere: "",
        };

        const errors = {};

        // Add event listeners for inputs
        document.querySelectorAll("input").forEach((input) => {
            input.addEventListener("input", (event) => {
                const { id, value } = event.target;
                formData[id] = value;

                // Example validation
                if (value.trim() === "") {
                    errors[id] = "Ce champ est requis.";
                } else {
                    delete errors[id];
                }

                // Display error messages
                const errorSpan = document.getElementById(`error-${id}`);
                if (errorSpan) {
                    errorSpan.textContent = errors[id] || "";
                }
            });
        });

        // Add submit logic if necessary
    });

</script>