<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>
    @if (session()->has('message'))
        <x-succes-notification>
            {{ session('message') }}
        </x-succes-notification>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification-content');
                const closeBtn = document.getElementById('close-notification');

                notification.classList.remove('hidden');

                closeBtn.addEventListener('click', () => {
                    notification.classList.add('hidden');
                });
            });
        </script>
    @endif

    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Demande d&apos;adhésion MU-POL</h2>
                        <ul class="bread-list">
                            <li><a href="index.html">Accueil</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Adhérer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <section class=" section">
        <div class="container">
            <div class="">
                <div class="row "> 
                    
                    <div class="col-lg-12">
                        <x-section-guest>
                            
                            <div class="w-[80%] md:w-3/6 lg:w-3/6  max-w-4xl mx-auto p-6 bg-white shadow-lg border rounded-lg">
                                <h2 class="text-base font-bold text-center  border-2 border-gray-300 rounded-md p-2 text-gray-800">Remplir la fiche de cession volontaire</h2>
                            
                                <form action="{{ route('finalisation-adhesion') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf 
                                    <input type="hidden" name="demande_adhesion_id" value="{{ $demandeAdhesion->id }}">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <!-- Région -->
                                        <div>
                                            <label for="region" class="block text-sm font-medium text-gray-700">Région</label>
                                            <select id="region" name="region" class="mt-1 bg-gray-100 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                <option value="" disabled selected>Choisissez votre région</option>
                                                <!-- Options à ajouter ici -->
                                            </select>
                                        </div>
                            
                                        <!-- Province -->
                                        <div>
                                            <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                                            <select id="province" name="province" class="mt-1 bg-gray-100 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required disabled>
                                                <option value="" disabled selected>Choisissez d&apos;abord votre région</option>
                                            </select>
                                        </div>
                            
                                    </div>
                                    <script>
                        
                        
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const regionSelect = document.getElementById("region");
                                            const provinceSelect = document.getElementById("province");
                                        
                                            for (const region in regions) {
                                                const option = document.createElement("option");
                                                option.value = region;
                                                option.textContent = region;
                                                regionSelect.appendChild(option);
                                            }
                                        
                                            regionSelect.addEventListener("change", function() {
                                                const selectedRegion = regionSelect.value;
                                        
                                                provinceSelect.innerHTML = "";
                                                provinceSelect.disabled = false;
                                        
                                                const defaultOption = document.createElement("option");
                                                defaultOption.value = "";
                                                defaultOption.disabled = true;
                                                defaultOption.selected = true;
                                                defaultOption.textContent = "Choisissez votre province";
                                                provinceSelect.appendChild(defaultOption);
                                        
                                                regions[selectedRegion].provinces.forEach(province => {
                                                    const option = document.createElement("option");
                                                    option.value = province;
                                                    option.textContent = province;
                                                    provinceSelect.appendChild(option);
                                                });
                                            });
                                        });
                                        
                                    </script>
                                    <div class="grid grid-cols-1 md:grid-cols-1 gap-3">
                                        <!-- Localité -->
                                        <div>
                                            <label for="localite" class="block text-sm font-medium text-gray-700">Localité</label>
                                            <input type="text" id="localite" name="localite" class="mt-1 bg-gray-100 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Entrez votre localité">
                                        </div>
                                    </div>
                                    <label for="signature" class="block text-sm font-medium text-gray-700">Signature</label>
                                    <label for="switcher" class="flex justify-center cursor-pointer p-1">
                                        <div class="relative text-xs bg-gray-200 rounded-full flex gap-3 justify-between p-2 h-[32px]">
                                            <input id="switcher" type="checkbox" class="hidden peer" onchange="toggleSignatureOptions()">
                                            <span class="text-center flex-grow relative  z-10  self-center transition text-white peer-checked:text-black">
                                                <i class="fa fa-pencil"></i>
                                                Dessiner
                                            </span>
                                            <span class="text-center flex-grow relative  z-10 self-center transition peer-checked:text-white">
                                                <i class="fa fa-image "></i>
                                                Charger
                                            </span>
                                            <span class="absolute toggle  bg-[#4000FF] h-full w-[50%] rounded-full transition-all top-0 left-0 peer-checked:left-[50%]"></span>
                                        </div>
                                    </label>
                                    
                                    <!-- Section pour choisir le mode de signature -->
                                    <div id="signatureOptions" class="grid grid-cols-1 md:grid-cols-1 ">
                                        <!-- Dessiner la signature -->
                                        <div id="drawSignature" class="flex flex-col p-4 border rounded-md bg-white h-full shadow-sm">
                                            <h4 class="text-center text-sm font-semibold mb-4">Dessiner la signature</h4>
                                            <canvas id="signatureCanvas" class="border rounded-md bg-white w-full h-40" style="border: 1px solid #000;"></canvas>
                                            <input type="hidden" id="signatureInput" name="signature" />
                                            <div class="w-full !text-xs flex justify-between mt-2">
                                                <x-primary-button type="button" id="saveButton" class="!text-xs bg-emerald-600 p-2 rounded-md text-white  transition">Enregistrer</x-primary-button>
                                                <x-primary-button type="button" id="clearButton" class="!text-xs bg-gray-400 p-2 rounded-md text-white  transition">Effacer</x-primary-button>
                                            </div>
                                        </div>
                                    
                                        <!-- Charger une image de la signature -->
                                        <div id="uploadSignature" class="hidden flex flex-col p-4 border rounded-md bg-white h-full shadow-sm">
                                            <h4 class="text-center text-sm font-semibold mb-4">Charger une image de signature</h4>
                                            <div class="border-dashed border-2 border-gray-300 rounded-md p-6 flex-grow flex justify-center items-center">
                                                <div class="text-center text-xs">
                                                    <img id="previewImage" class="hidden w-full h-auto max-h-48 object-cover mb-4" />
                                                    <p class="text-gray-500">Déposez votre image ici ou</p>
                                                    <label for="signatureImage" class="cursor-pointer text-blue-500 hover:underline">cliquez pour choisir une image</label>
                                                    <input type="file" id="signatureImage" class="hidden" accept="image/*" name="signatureImage">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        function toggleSignatureOptions() {
                                            const switcher = document.getElementById('switcher');
                                            const drawSignature = document.getElementById('drawSignature');
                                            const uploadSignature = document.getElementById('uploadSignature');
                                    
                                            if (switcher.checked) {
                                                drawSignature.classList.add('hidden');
                                                uploadSignature.classList.remove('hidden');
                                            } else {
                                                drawSignature.classList.remove('hidden');
                                                uploadSignature.classList.add('hidden');
                                            }
                                        }
                                    </script>
                                    
                                    
                            
                                    <!-- Bouton de soumission -->
                                    <div class="flex justify-end">
                                        <x-primary-button type="submit" class="">Soumettre</x-primary-button>
                                    </div>
                                </form>
                            </div>
                            
                            
                            <script>
                                const canvas = document.getElementById('signatureCanvas');
                                const context = canvas.getContext('2d');
                                let drawing = false;
                            
                                canvas.width = canvas.offsetWidth;
                                canvas.height = canvas.offsetHeight;
                            
                                canvas.addEventListener('mousedown', startDrawing);
                                canvas.addEventListener('mouseup', stopDrawing);
                                canvas.addEventListener('mousemove', draw);
                                canvas.addEventListener('mouseleave', stopDrawing);
                            
                                function startDrawing(event) {
                                    drawing = true;
                                    draw(event);
                                }
                            
                                function stopDrawing() {
                                    drawing = false;
                                    context.beginPath();
                                }
                            
                                function draw(event) {
                                    if (!drawing) return;
                            
                                    context.lineWidth = 2;
                                    context.lineCap = 'round'; 
                                    context.strokeStyle = 'black'; 
                            
                                    context.lineTo(event.clientX - canvas.getBoundingClientRect().left, event.clientY - canvas.getBoundingClientRect().top);
                                    context.stroke();
                                    context.beginPath();
                                    context.moveTo(event.clientX - canvas.getBoundingClientRect().left, event.clientY - canvas.getBoundingClientRect().top);
                                }
                            
                                // Gérer l'enregistrement de la signature
                                document.getElementById('saveButton').addEventListener('click', () => {
                                    const dataURL = canvas.toDataURL(); 
                                    document.getElementById('signatureInput').value = dataURL; 
                                    alert("Signature enregistrée !");
                                });
                            
                                document.getElementById('clearButton').addEventListener('click', () => {
                                    context.clearRect(0, 0, canvas.width, canvas.height); 
                                    document.getElementById('signatureInput').value = ''; 
                                });
                            </script>
                            
                            <script>
                                const signatureImageInput = document.getElementById('signatureImage');
                                const previewImage = document.getElementById('previewImage');
                                const signatureInput = document.getElementById('signatureInput');
                            
                                signatureImageInput.addEventListener('change', function() {
                                    const file = this.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            previewImage.src = e.target.result;
                                            previewImage.classList.remove('hidden');
                            
                                            signatureInput.value = e.target.result; 
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
                            
                            
                        </x-section-guest>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    
    <x-footer/>

</x-guest-layout>


