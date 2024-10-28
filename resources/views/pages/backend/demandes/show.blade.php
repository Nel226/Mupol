<x-app-layout>
    <x-sidebar/>
    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
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
    <x-content-page>

        <div class="flex-1 p-6">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">{{$pageTitle}}</h1>
            </div>
            
            
            <div class="p-6 mx-auto mt-4 bg-white rounded-lg  ">
                
                <style>
                   
                
                    .table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 10px;
                    }
                
                    .table th,
                    .table td {
                        border: 2px solid gray;
                        padding: 8px;
                    }
                
                    .document {
                        max-width: 800px;
                        margin: auto;
                        padding: 20px;
                    }
                
                    fieldset {
                        margin-top: 10px;
                    }
                
                    legend {
                        font-size: 1rem;
                        padding: 0 10px;
                    }
                
                    ul {
                        margin-top: 10px;
                    }
                
                    p {
                        margin: 5px 0;
                    }
                </style>
                
                <div class="adhesion-form 3 max-w-5xl mx-auto p-10 bg-white shadow-lg rounded-lg">
                    <div class="flex justify-between items-center mx-auto pb-2 w-11/12 mb-2">
                        <!-- Colonne 1 -->
                        <div class="flex flex-col space-y-1 items-center text-center leading-none self-start">
                            <p>MUTUELLE DE LA POLICE NATIONALE</p>
                            <div class="border-t-[2px] border-black  w-1/4"></div> <!-- Trait -->
                            <p>CONSEIL D&apos;ADMINISTRATION</p>
                            <div class="border-t-[2px] border-black  w-1/4"></div> <!-- Trait -->
                            <p>SECRÉTARIAT GÉNÉRAL</p>
                        </div>
                
                        <!-- Colonne 2 (Logo) -->
                        <div class="flex h-full items-center self-start">
                            <img src="{{ asset('images/logofinal.png') }}" alt="Logo" class="h-full w-20 object-contain">
                        </div>
                
                        <!-- Colonne 3 -->
                        <div class="flex flex-col self-start text-center space-y-1 leading-none">
                            <p>BURKINA FASO</p>
                            <p>Unité - Progrès - Justice</p>
                        </div>
                    </div>
                
                    <!-- Titre principal -->
                    <div class="flex flex-col items-center space-y-0">
                        <h2 class="text-center text-3xl font-bold mt-0">FORMULAIRE D'ADHÉSION</h2>
                
                        <!-- Sous-titre avec surlignage -->
                        <h1 class="text-center text-1xl text-white font-bold bg-black px-3 inline-block">
                            À REMPLIR EN CARACTÈRES D'IMPRIMERIE
                        </h1>
                    </div>
                
                
                    <div>
                        <p><strong>Matricule :</strong> {{ $demande->matricule }}</p>
                    </div>
                    
                    <!-- Section : Références adhérent -->
                    <div class="section border-t border-gray-300 mt-2 pt-3">
                        <div class="flex">
                            <!-- Colonne Références -->
                            <div class="w-3/4">
                                <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">RÉFÉRENCES DE L&apos;ADHÉRENT</h3>
                
                                <div>
                                    <p><strong>Matricule :</strong> {{ $demande->matricule }}</p>
                                </div>
                
                                <!-- NIP et CNIB sur la même ligne -->
                                <div class="flex space-x-0 leading-none">
                                    <p class="flex-1"><strong>NIP :</strong> {{ $demande->nip }}</p>
                                    <p class="flex-1"><strong>CNIB :</strong> {{ $demande->cnib }}</p>
                                </div>
                
                                <div class="flex space-x-4">
                                    <!-- Colonne pour DÉLIVRÉE LE et la date -->
                                    <div class="flex-1 w-1/2 leading-none">
                                        <div class="flex">
                                            <!-- Première colonne : DÉLIVRÉE LE et (JJ/MM/AAAA) -->
                                            <div class="flex-shrink-0 ">
                                                <p class="mr-1"><strong>DÉLIVRÉE LE :</strong></p>
                                                <p class="text-xs"><small>(JJ/MM/AAAA)</small></p>
                                            </div>
                
                                            <!-- Deuxième colonne : valeur de la date de délivrance -->
                                            <div class="flex-1">
                                                <p>{{ $demande->delivree }}</p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="flex  w-1/2 leading-none">
                                        <!-- Première colonne : EXPIRE LE et (JJ/MM/AAAA) -->
                                        <div class="flex-shrink-0 ">
                                            <p class="mr-1"><strong>EXPIRE LE :</strong></p>
                                            <p class="text-xs"><small>(JJ/MM/AAAA)</small></p>
                                        </div>
                
                                        <div class="flex-1">
                                            <p>{{ $demande->expire }}</p>
                                        </div>
                                    </div>
                
                                </div>
                
                            </div>
                
                            <!-- Colonne Signature -->
                            <div class="w-1/4 items-center px-2 justify-center flex flex-col">
                                <h3 class="text-xs underline decoration-solid ">SIGNATURE DE L’ADHÉRENT</h3>
                                <div class="w-full flex-grow border-2 border-black mt-2 flex items-center justify-center">
                                    <img src="{{ $demande->signature}}" alt="">
                                </div>
                            </div>
                        </div>
                
                        <div>
                            <p><strong>Adresse :</strong> {{ $demande->adresse_permanente }}</p>
                        </div>
                
                        <div class="flex space-x-4">
                            <p class="flex-1"><strong>Téléphone :</strong> {{ $demande->telephone }}</p>
                            <p class="flex-1"><strong>Email :</strong> {{ $demande->email }}</p>
                        </div>
                    </div>
                
                
                    <!-- Section : État civil -->
                    <div class="section border-t border-gray-300 mt-1 pt-3">
                
                        <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">ÉTAT CIVIL</h3>
                
                        <div class="flex">
                            <div class="w-3/4">
                                <div class="mt-2">
                                    <p><strong>Nom :</strong> {{ $demande->nom }}</p>
                                    <p><strong>Prénom(s) :</strong> {{ $demande->prenom }}</p>
                                </div>
                                <div class="flex items-center space-x-2 mt-1">
                                    <!-- Colonne 1 : Lieu de naissance -->
                                    <div class="flex-shrink-0">
                                        <p><strong>Lieu de naissance </strong></p>
                                    </div>
                
                                    <!-- Colonne 2 : Barre verticale -->
                                    <div class="border-l-2 border-gray-400 h-16 mx-2"></div>
                
                                    <!-- Colonne 3 : Infos supplémentaires -->
                                    <div class="flex-1">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <p class="mr-1"><strong>Département</strong></p>
                                                <p class="mr-1"><strong>Ville / Village</strong></p>
                                                <div class="leading-none">
                                                    <p class="mr-1"><strong>Pays</strong></p>
                                                    <p class="text-xs"><small>(Si vous êtes né(e) hors du pays)</small></p>
                                                </div>
                                            </div>
                
                                            <div class="flex-1">
                                                <p> <strong>:</strong> {{ $demande->departement }}</p>
                                                <p> <strong>:</strong> {{ $demande->ville }}</p>
                                                <p> <strong>:</strong> {{ $demande->pays }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="w-1/4 flex items-center px-2 justify-center">
                                <div class="w-full h-1/2 flex-grow border-2 border-black mt-2 flex items-center justify-center">
                                    <p class="mr-2"><strong class="mr-1">Genre
                                            :</strong>{{ $demande->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                                </div>
                            </div>
                        </div>
                
                        <p><strong>Nom du père :</strong> {{ $demande->nom_pere }}</p>
                        <p><strong>Nom de la mère :</strong> {{ $demande->nom_mere }}</p>
                    </div>
                
                
                    <!-- Section : Informations Personnelles -->
                    <div class="section border-t border-gray-300 mt-2 pt-3">
                        <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">INFORMATIONS PERSONNELLES</h3>
                
                        <div>
                            <p><strong>Situation matrimoniale :</strong> {{ $demande->situation_matrimoniale }} </p>
                        </div>
                
                        <fieldset class="border-2 border-gray-400 leading-none rounded-lg">
                            <legend class="font-semibold bg-white pr-2 mx-4 flex items-center">
                                <span class="text-black text-lg">></span>
                                Personnes à prévenir en cas de besoin
                            </legend>
                            <div class="px-1">
                                <p><strong>Nom & Prénom(s) :</strong> {{ $demande->nom_prenom_personne_besoin }} </p>
                
                                <div class="flex space-x-4"> <!-- Flexbox avec un espace entre les éléments -->
                                    <p class="flex-1"><strong>Lieu de résidence :</strong>
                                        {{ $demande->lieu_residence }}</p>
                                    <p class="flex-1"><strong>Téléphone :</strong>
                                        {{ $demande->telephone_personne_prevenir }}</p>
                                </div>
                            </div>
                        </fieldset>
                
                        @if ($demande->nombreAyantsDroits > 0)
                            <div class="pt-4 text-center text-2xl font-bold">
                                <h2 class=" leading-none">LISTE DES AYANTS DROITS</h2>
                            </div>
                            <table class="table leading-none w-full border-collapse border-2 border-gray-400 text-left">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="border border-gray-400">N°</th>
                                        <th class="border border-gray-400">Nom</th>
                                        <th class="border border-gray-400">Prénom(s)</th>
                                        <th class="border border-gray-400">Sexe</th>
                                        <th class="border border-gray-400">Date de naissance</th>
                                        <th class="border border-gray-400">Lien de parenté</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demande->ayantsDroits as $index => $ayantDroit)
                                        <tr>
                                            <td class="border border-gray-400">{{ $index + 1 }}</td>
                                            <td class="border border-gray-400">{{ $ayantDroit['nom'] }}</td>
                                            <td class="border border-gray-400">{{ $ayantDroit['prenom'] }}</td>
                                            <td class="border border-gray-400">
                                                @if ($ayantDroit['sexe'] === 'H')
                                                    Homme
                                                @elseif ($ayantDroit['sexe'] === 'F')
                                                    Femme
                                                @else
                                                    Non spécifié
                                                @endif
                                            </td>
                                            <td class="border border-gray-400">{{ $ayantDroit['date_naissance'] }}</td>
                                            <td class="border border-gray-400">{{ $ayantDroit['lien_parente'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                
                    <!-- Section : Formations professionnelles -->
                    <div class="section border-t border-gray-300 mt-2 pt-4">
                        <h3 class="text-1xl font-semibold mb-2 bg-gray-500 px-auto px-1">INFORMATIONS PROFESSIONELLES</h3>
                        
                        <!-- Personnel Retraité -->
                        @if ($demande->statut === 'personnel_retraite')
                            <div class="border p-2 rounded-lg mb-2 leading-none">
                                <div class="text-center">
                                    <p><strong>{{ $demande->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                                </div>
                                <div>
                                    <div>
                                        <p><strong>Grade :</strong> {{ $demande->grade }}</p>
                                    </div>
                
                                </div>
                                <div class="flex space-x-4">
                                    <div class="flex-1 w-1/2 leading-none">
                                        <div class="flex leading-none">
                                            <div class="flex-shrink-0 leading-none">
                                                <p class="mr-1 leading-none"><strong>Date depart à la retraite :</strong></p>
                                                <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                            </div>
                                            <div class="flex-1">
                                                <p>{{ $demande->departARetraite }}</p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="flex  w-1/2 leading-none">
                                        <p><strong>N° CARFO :</strong> {{ $demande->numeroCARFO }}</p>
                                    </div>
                
                                </div>
                            </div>
                        @endif
                        
                        <!-- Personnel en Activité -->
                        @if ($demande->statut === 'personnel_active')
                            <div class="border px-2 rounded-lg leading-none">
                                <div class="text-center">
                                    <p><strong>{{ $demande->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                                </div>
                                <div>
                                    <div>
                                        <p><strong>Grade :</strong> {{ $demande->grade }}</p>
                                    </div>
                
                                    <div class="flex space-x-4">
                                        <div class="flex-1 w-1/2 leading-none">
                                            <div class="flex">
                                                <div class="flex-shrink-0 leading-none">
                                                    <p class="mr-1 leading-none"><strong>Date d&apos;intégration :</strong></p>
                                                    <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                                </div>
                                                <div class="flex-1">
                                                    <p>{{ $demande->dateIntegration }}</p>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="flex  w-1/2 leading-none">
                                            <div class="flex-shrink-0 leading-none">
                                                <p class="mr-1 leading-none"><strong>Date de départ à la rétraite :</strong></p>
                                                <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                            </div>
                
                                            <div class="flex-1">
                                                <p>{{ $demande->dateDepartARetraite }}</p>
                                            </div>
                                        </div>
                
                                    </div>
                
                                    <div class="flex space-x-0">
                                        <p class="flex-1"><strong>Direction :</strong> {{ $demande->direction }}</p>
                                        <p class="flex-1"><strong>Service :</strong> {{ $demande->service }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        
                        <div class="flex">
                            <!-- Colonne Références -->
                            <div class="w-3/4 flex items-center justify-center">
                                <div class="rounded-lg text-1xl border-2 border-black font-semibold px-1">
                
                                    <h3>JOINDRE DES PHOTOS RECENTES DE L’ADHERENT ET DES AYANTS DROITS</h3>
                                    <h3 class=" text-1xl font-semibol px-auto px-1">
                                        	joindre une copie de l’extrait de naissance de chaque enfant
                                    </h3>
                                    <h3>
                                        	joindre une copie de l’extrait de naissance et de la CNIB pour la ou le(s) conjoint(es)
                                    </h3>
                                </div>
                
                            </div>
                
                            <!-- Colonne Signature -->
                            <div class="w-[20%] items-center px-2 justify-end flex-col ml-auto">
                                <h3 class="text-xs text-center underline decoration-solid ">VISA DU PRESIDENT DU CONSEIL D’ADMINISTRATION</h3>
                                <div class="w-full h-32 flex-grow border-2 border-black flex items-center justify-center">
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                @if ($demande->nombreAyantsDroits > 0)
                <div class="pt-4 text-center text-lg font-bold">
                    <h4 class="leading-none text-gray-700">Pièces jointes des Ayants Droits</h4>
                </div>
                <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden mt-6">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-4 text-center">Photo</th>
                            <th class="py-3 px-4">Nom</th>
                            <th class="py-3 px-4">Prénom(s)</th>
                            <th class="py-3 px-4">Sexe</th>
                            <th class="py-3 px-4">Lien de parenté</th>
                            <th class="py-3 px-4 text-center">CNIB</th>
                            <th class="py-3 px-4 text-center">Extrait</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @foreach ($demande->ayantsDroits as $index => $ayantDroit)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <!-- Colonne pour la photo -->
                                <td class="py-3 px-4 text-center">
                                    <div class="flex justify-center">
                                        @if (isset($ayantDroit['photo_path']))
                                            <button class="open-modal-button text-blue-500 hover:text-blue-700" 
                                                    data-url="{{ asset('storage/' . $ayantDroit['photo_path']) }}" type="button">
                                                    <img class="w-10 h-10 rounded-full cursor-pointer" src="{{ asset('storage/' . $ayantDroit['photo_path']) }}" 
                                                        alt="Photo de {{ $ayantDroit['nom'] }}" 
                                                        onclick="openModal('{{ asset('storage/' . $ayantDroit['photo_path']) }}')" />
                                            </button>
                                        @else
                                            <span class="text-gray-500">N/A</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">{{ $ayantDroit['nom'] }}</td>
                                <td class="py-3 px-4">{{ $ayantDroit['prenom'] }}</td>
                                <td class="py-3 px-4">
                                    @if ($ayantDroit['sexe'] === 'H') M @elseif ($ayantDroit['sexe'] === 'F') F @else Non spécifié @endif
                                </td>
                                <td class="py-3 px-4">{{ $ayantDroit['lien_parente'] }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if (isset($ayantDroit['cnib_path']))
                                        <button class="open-modal-button text-blue-500 hover:text-blue-700" 
                                                data-url="{{ asset('storage/' . $ayantDroit['cnib_path']) }}" type="button">
                                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                        </button>
                                    @else
                                        <span class="text-gray-500">Non disponible</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if (isset($ayantDroit['extrait_path']))
                                        <button class="open-modal-button text-red-500 hover:text-red-700" 
                                                data-url="{{ asset('storage/' . $ayantDroit['extrait_path']) }}" type="button">
                                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                        </button>
                                    @else
                                        <span class="text-gray-500">Non disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            
            <!-- Modal -->
            <div id="attachment-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center bg-black bg-opacity-60 justify-center">
                <div class="relative p-4 w-full max-w-[80%] max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Pièce Jointe</h3>
                            <button type="button" id="closeModalButton" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Fermer modal</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <iframe id="attachmentFrame" class="w-full h-96" src="" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const attachmentModal = document.getElementById('attachment-modal');
                const attachmentFrame = document.getElementById('attachmentFrame');
                const closeModalButton = document.getElementById('closeModalButton');
                
                document.querySelectorAll('.open-modal-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const attachmentUrl = this.getAttribute('data-url');
                        attachmentFrame.src = attachmentUrl;
                        attachmentModal.classList.remove('hidden');
                    });
                });

                closeModalButton.addEventListener('click', function() {
                    attachmentModal.classList.add('hidden');
                    attachmentFrame.src = ""; // Reset du src pour éviter de recharger
                });

                window.addEventListener('click', function(event) {
                    if (event.target === attachmentModal) {
                        attachmentModal.classList.add('hidden');
                        attachmentFrame.src = "";
                    }
                });
            </script>


                               
            </div>
            
        </div>
    </x-content-page>
    
    
</x-app-layout>
