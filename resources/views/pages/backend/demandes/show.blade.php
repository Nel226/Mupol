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
            
            
<<<<<<< Updated upstream
            <div class="p-6 mx-auto mt-4 bg-gray-100 min-h-screen  rounded-lg  ">
=======
            <div class="p-6 mx-auto mt-4 bg-white rounded-lg shadow-lg ">
               
                
                <style>
>>>>>>> Stashed changes
                   
                <div class="adhesion-form mx-auto">
                    <!-- Card container -->
                    <div class="max-w-3xl mx-auto space-y-6">
                        
                        <!-- Références de l&apos;adhérent -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <!-- Photo de l'adhérent -->
                            <div class="flex items-center justify-center mb-6">
                                <img src="{{ asset('storage/' . $demande->photo) }}" alt="Photo de l&apos;adhérent" class="w-24 h-24 rounded-full border-4 border-gray-200 shadow-md">
                            </div>
                
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Références de l'adhérent</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Matricule :</strong> {{ $demande->matricule }}</p>
                                <p><strong>NIP :</strong> {{ $demande->nip }}</p>
                                <p><strong>CNIB :</strong> {{ $demande->cnib }}</p>
                                <p><strong>Adresse :</strong> {{ $demande->adresse_permanente }}</p>
                                <p><strong>Téléphone :</strong> {{ $demande->telephone }}</p>
                                <p><strong>Email :</strong> {{ $demande->email }}</p>
                            </div>
                        </div>
                
                        <!-- État civil -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">État civil</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Nom :</strong> {{ $demande->nom }}</p>
                                <p><strong>Prénom(s) :</strong> {{ $demande->prenom }}</p>
                                <p><strong>Lieu de naissance :</strong> {{ $demande->lieu_naissance }}</p>
                                <p><strong>Genre :</strong> {{ $demande->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                                <p><strong>Nom du père :</strong> {{ $demande->nom_pere }}</p>
                                <p><strong>Nom de la mère :</strong> {{ $demande->nom_mere }}</p>
                            </div>
                        </div>
                
                        <!-- Informations personnelles -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Informations personnelles</h3>

                            <!-- Situation matrimoniale -->
                            <p class="text-gray-600 text-sm mb-2"><strong>Situation matrimoniale :</strong> {{ $demande->situation_matrimoniale }}</p>
                        
                            <!-- Personnes à prévenir en cas de besoin -->
                            <!-- Personnes à prévenir en cas de besoin -->
                            <div class="mt-6 bg-gray-50 shadow-md rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Personnes à prévenir en cas de besoin</h4>
                                
                                <div class="flex items-center mb-3">
                                    <span class="material-icons text-gray-500 mr-2">person</span>
                                    <p class="text-gray-700 text-sm"><strong>Nom & Prénom(s) :</strong> {{ $demande->nom_prenom_personne_besoin }}</p>
                                </div>

                                <div class="flex items-center mb-3">
                                    <span class="material-icons text-gray-500 mr-2">home</span>
                                    <p class="text-gray-700 text-sm"><strong>Lieu de résidence :</strong> {{ $demande->lieu_residence }}</p>
                                </div>

                                <div class="flex items-center">
                                    <span class="material-icons text-gray-500 mr-2">phone</span>
                                    <p class="text-gray-700 text-sm"><strong>Téléphone :</strong> {{ $demande->telephone_personne_prevenir }}</p>
                                </div>
                            </div>

                        </div>
                
                        <!-- Liste des ayants droits -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Liste des ayants droits</h3>
                            <div class="overflow-x-auto">
                                @if ($demande->nombreAyantsDroits > 0)
                             
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
<<<<<<< Updated upstream
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
=======
                                    @endforeach
                                </tbody>
                            </table>
                        @endif  --}}
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
>>>>>>> Stashed changes
                            </div>
                        </div>

                        <!-- Informations profesionnelles -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Informations Professionnelles</h3>
                            <!-- Personnel Retraité -->
                            @if ($demande->statut === 'personnel_retraite')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Statut :</strong> {{ $demande->statut }}</p>
                                <p><strong>Grade :</strong> {{ $demande->grade }}</p>
                                <p><strong>Date de départ à la retraite :</strong> {{ $demande->departARetraite }} <span class="text-xs">(JJ/MM/AAAA)</span></p>
                                <p><strong>N° CARFO :</strong> {{ $demande->numeroCARFO }}</p>
                            </div>
                               
                            @endif
                            
                            <!-- Personnel en Activité -->
                            @if ($demande->statut === 'personnel_active')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Statut :</strong> {{ $demande->statut }}</p>

                                <p><strong>Grade :</strong> {{ $demande->grade }}</p>
                                <p><strong>Date d&apos;intégration :</strong> {{ $demande->dateIntegration }} <span class="text-xs">(JJ/MM/AAAA)</span></p>
                                <p><strong>Date de départ à la retraite :</strong> {{ $demande->dateDepartARetraite }} </p>
                                <p><strong>Direction :</strong> {{ $demande->direction }}</p>
                                <p><strong>Service :</strong> {{ $demande->service }}</p>
                            </div>
                             
                            @endif
                        </div>
                
                        <!-- Modifier les informations -->
                        <div class="text-right mt-6">
                            <a href="{{ route('edit-demande-adhesion', ['id'=>$demande->id]) }}">

                                <x-primary-button class="">
                                    <i class=" fa fa-pencil mr-2"></i>
                                    Modifier les informations
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                
                
                

            
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
            <fieldset>
                <legend>Pièces jointes</legend>
                <div>
                    
                </div>
            </fieldset>
            
        </div>
    </x-content-page>
    
    
</x-app-layout>
