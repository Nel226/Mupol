<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="lg:block z-20 hidden bg-blue-800 w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        <x-header>
            {{ $pageTitle }}
        </x-header>
        
        <div class="">
            <div class="adhesion-form mx-auto">
                <!-- Card container -->
                <div class=" mx-auto space-y-6">
                    
                    <!-- Références de l&apos;adhérent -->
                    <!-- Photo de -->
                    <div class="flex items-center justify-center mb-6">
                        <img src="{{ asset('storage/' . $demande->photo) }}" alt="Photo de l&apos;adhérent" class="w-24 h-24 rounded-full border-4 border-gray-200 shadow-md">
                    </div>
                    {{-- Messages d'erreur et de succès --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Une erreur s&apos;est produite :</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Succès :</strong>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Erreur :</strong>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($demande->is_new === 0 )
                        <div class="bg-white shadow-md rounded-lg p-6">
                    
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-left">Informations de la demande</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Nom :</strong> {{ $demande->nom  }}</p>
                                <p><strong>Prénom (s) :</strong> {{ $demande->prenom }}</p>
                                <p><strong>Matricule :</strong> {{ $demande->matricule }}</p>
                                <p><strong>Téléphone :</strong> {{ $demande->telephone }}</p>
                                <p><strong>Email :</strong> {{ $demande->email }}</p>
                            </div>
                            <div class="flex justify-end mt-2">

                                <a href="{{ route('demandes.edit', $demande->id) }}">
    
                                    <button class="btn">
                                        <i class=" fa fa-pencil mr-2"></i>
                                        Modifier la demande
                                    </button>
                                </a> 
                            </div>
                        </div>
                        <div class="bg-white shadow-md rounded-lg p-6">
                            @if (!is_null($adherent))

                                <div class="bg-green-100 border text-sm border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <strong class="font-bold">Demande valide :</strong>
                                    <span>{{ $message }}</span>
                                </div>
                                <dl class="grid gap-3 sm:grid-cols-2 grid-cols-1">

                                    <!-- Nom -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Nom :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('nom', $adherent->nom) }}
                                        </dd>
                                    </div>
            
                                    
            
                                    <!-- Téléphone -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Téléphone :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('telephone', $adherent->telephone) }}
                                        </dd>
                                    </div>
                                    <!-- Prénom(s) -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Prénom(s) :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('prenom', $adherent->prenom) }}
                                        </dd>
                                    </div>
            
                                    <!-- Code carte -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Code carte :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('code_carte', $adherent->code_carte) }}
                                        </dd>
                                    </div>
                                   
                                    <!-- Genre -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Genre :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('genre', $adherent->genre) }}
                                        </dd>
                                    </div>
                                    <!-- Charges -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Nombre de charges :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('charge', $adherent->charge) }}
                                        </dd>
                                    </div>
                                    <!-- Matricule -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Matricule :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('matricule', $adherent->matricule) }}
                                        </dd>
                                    </div>
                                    <!-- Mensualite -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Mensualité :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('mensualite', $adherent->mensualite) }} F CFA
                                        </dd>
                                    </div>
                                    
                                    <!-- Service -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Service :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('service', $adherent->service) }}
                                        </dd>
                                    </div>
                                    
                                    <!-- Date -->
                                    <div class="flex items-center space-x-2">
                                        <dt class="text-sm font-medium text-gray-900 dark:text-white">Date d&apos;adhésion :</dt>
                                        <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ old('date_enregistrement', $adherent->date_enregistrement) ? \Carbon\Carbon::parse(old('date_enregistrement', $adherent->date_enregistrement))->format('d/m/Y') : '' }}
                                        </dd>
                                    </div>
                                                        
                                </dl>
                                
                            @else
                                <div class="bg-red-100 border text-sm border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <strong class="font-bold">Demande invalide :</strong>
                                    <span>{{ $message }}</span>
                                </div>
                                
                            @endif
                            
                        </div>
                    @else
                        <p class="text-sm font-semibold text-right space-x-1">
                            <a class="text-primary1 underline cursor-pointer" onclick="previewFile('{{ route('preview-formulaire-adhesion', ['id' => $demande->id]) }}', 'Formulaire d’adhésion')">
                                <i class="fa fa-list-alt"></i>
                                Formulaire d’adhésion
                            </a>
                            <a class="text-primary1 underline cursor-pointer" onclick="previewFile('{{ route('preview-fiche-cession-volontaire', ['id' => $demande->id]) }}', 'Fiche de cession volontaire')">
                                <i class="fa fa-list-alt"></i>
                                Fiche de cession volontaire
                            </a>
                        </p>
                        
                        <div id="filePreview" class="mt-1 hidden transition-opacity duration-300 ease-in-out">
                            <div class="flex justify-between items-center bg-gray-100 px-4 py-2 border-b">
                                <h3 id="previewTitle" class="text-sm font-semibold"></h3>
                                <button onclick="closePreview()" class="text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>
                            </div>
                            <iframe id="previewFrame" src="" class="w-full h-screen  border"></iframe>
                        </div>
                        
                        <script>
                            function previewFile(fileUrl, title) {
                                fetch(fileUrl, { method: 'HEAD' }) // Vérifie si le fichier existe
                                    .then(response => {
                                        if (response.ok) {
                                            document.getElementById('previewFrame').src = fileUrl;
                                            document.getElementById('previewTitle').innerText = title;
                                            document.getElementById('filePreview').classList.remove('hidden');
                                        } else {
                                            alert("Le fichier demandé n'existe pas encore.");
                                        }
                                    })
                                    .catch(error => {
                                        alert("Erreur lors de la récupération du fichier.");
                                    });
                            }
                        
                            function closePreview() {
                                document.getElementById('filePreview').classList.add('hidden');
                                document.getElementById('previewFrame').src = ""; // Réinitialise l'iframe
                            }
                        </script>
                    
                        
                    
                        
                        <div class="bg-white shadow-md rounded-lg p-6">
                
                            <h3 class="text-base font-semibold text-gray-800 mb-4 ">
                                <span class="text-white bg-blue-800 rounded-full py-0.5 px-2">1</span>
                                Références 
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Matricule :</strong> {{ $demande->matricule }}</p>
                                <p><strong>NIP :</strong> {{ $demande->nip }}</p>
                                <p><strong>CNIB :</strong> {{ $demande->cnib }}</p>
                                <p><strong>Adresse :</strong> {{ $demande->adresse }}</p>
                                <p><strong>Téléphone :</strong> {{ $demande->telephone }}</p>
                                <p><strong>Email :</strong> {{ $demande->email }}</p>
                            </div>
                        </div>
                
                        <!-- État civil -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                <span class="text-white bg-blue-800 rounded-full py-0.5 px-2">2</span>
                                État civil
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Nom :</strong> {{ $demande->nom }}</p>
                                <p><strong>Prénom(s) :</strong> {{ $demande->prenom }}</p>
                                <p><strong>Lieu de naissance :</strong> {{ $demande->departement }}, {{ $demande->ville }}</p>
                                <p><strong>Genre :</strong> {{ $demande->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                                <p><strong>Nom du père :</strong> {{ $demande->nom_pere }}</p>
                                <p><strong>Nom de la mère :</strong> {{ $demande->nom_mere }}</p>
                            </div>
                        </div>
                
                        <!-- Informations personnelles -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                <span class="text-white bg-blue-800 rounded-full py-0.5 px-2">3</span>
                                Informations personnelles
                            </h3>

                            <!-- Situation matrimoniale -->
                            <p class="text-gray-600 text-sm mb-2"><strong>Situation matrimoniale :</strong> {{ $demande->situation_matrimoniale }}</p>
                        
                            <!-- Personnes à prévenir en cas de besoin -->
                            <div class="mt-6 bg-gray-50 shadow-md rounded-lg p-4">
                                <h4 class="text-sm font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Personne à prévenir en cas de besoin</h4>
                                
                                <div class="flex items-center mb-3">
                                    <i class=" fa fa-user text-gray-500 mr-2"></i>
                                    <p class="text-gray-700 text-sm"><strong>Nom & Prénom(s) :</strong> {{ $demande->nom_prenom_personne_besoin }}</p>
                                </div>

                                <div class="flex items-center mb-3">
                                    <i class=" fa fa-home text-gray-500 mr-2"></i>
                                    <p class="text-gray-700 text-sm"><strong>Lieu de résidence :</strong> {{ $demande->lieu_residence }}</p>
                                </div>

                                <div class="flex items-center">
                                    <i class=" fa fa-phone text-gray-500 mr-2"></i>
                                    <p class="text-gray-700 text-sm"><strong>Téléphone :</strong> {{ $demande->telephone_personne_prevenir }}</p>
                                </div>
                            </div>

                        </div>
                
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                Liste des ayants droit
                            </h3>
                            <div class="overflow-x-auto">
                                @if ($demande->nombreAyantsDroits > 0)
                                <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden mt-6">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                                            <th class="py-1 px-4 text-center">Photo</th>
                                            <th class="py-1 px-4">Nom</th>
                                            <th class="py-1 px-4">Prénom(s)</th>
                                            <th class="py-1 px-4">Sexe</th>
                                            <th class="py-1 px-4">Lien de parenté</th>
                                            <th class="py-1 px-4 text-center">CNIB</th>
                                            <th class="py-1 px-4 text-center">Extrait</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($demande->ayantsDroits) && is_iterable($demande->ayantsDroits))
                                            @foreach ($demande->ayantsDroits as $index => $ayantDroit)
                                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                    <!-- Photo -->
                                                    <td class="py-3 px-4 text-center">
                                                        {{-- <img 
                                                            src="{{ asset($ayantDroit['photo']) }}" 
                                                            alt="Photo de {{ $ayantDroit['nom'] }}" 
                                                            class="w-10 h-10 rounded-full object-cover mx-auto"
                                                        /> --}}
                                                    </td>
                                
                                                    <!-- Nom -->
                                                    <td class="py-3 px-4">{{ $ayantDroit['nom'] }}</td>
                                
                                                    <!-- Prénom(s) -->
                                                    <td class="py-3 px-4">{{ $ayantDroit['prenom'] }}</td>
                                
                                                    <!-- Sexe -->
                                                    <td class="py-3 px-4">{{ ucfirst($ayantDroit['sexe']) }}</td>
                                
                                                    <!-- Lien de parenté -->
                                                    <td class="py-3 px-4">{{ $ayantDroit['relation'] }}</td>
                                
                                                    {{-- <!-- CNIB -->
                                                    <td class="py-3 px-4 text-center">
                                                        @if($ayantDroit['cnib'])
                                                            {{ $ayantDroit['cnib'] }}
                                                        @else
                                                            <span class="text-gray-500">Non disponible</span>
                                                        @endif
                                                    </td> --}}
                                
                                                    <!-- Extrait -->
                                                    <td class="py-3 px-4 text-center">
                                                        @php
                                                            $extrait = $ayantDroit['extrait'] ?? $ayantDroit['extrait_path'] ?? null;
                                                        @endphp
                                                    
                                                        @if($extrait)
                                                            <a 
                                                                href="{{ asset($extrait) }}" 
                                                                target="_blank" 
                                                                class="text-blue-600 hover:underline"
                                                            >
                                                                Voir
                                                            </a>
                                                        @else
                                                            <span class="text-gray-500">Non disponible</span>
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="py-3 px-4 text-center text-gray-500">
                                                    Aucun ayant droit disponible
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            @else
                                <p class="text-gray-600">Aucun ayant droit enregistré pour cette demande.</p>
                            @endif
                            
                            </div>
                        </div>
                        

                        <!-- Informations profesionnelles -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                <span class="text-white bg-blue-800 rounded-full py-0.5 px-2">4</span>

                                Informations Professionnelles
                            </h3>
                            <!-- Personnel Retraité -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
                                <p><strong>Statut :</strong> {{ $demande->statut }}</p>
                                <p><strong>Grade :</strong> {{ $demande->grade }}</p>
                                @if ($demande->statut === 'Retraité(e)')
                                    <p><strong>Date de départ à la retraite :</strong> {{ $demande->departARetraite }} <span class="text-xs">(JJ/MM/AAAA)</span></p>
                                    <p><strong>N° CARFO :</strong> {{ $demande->numeroCARFO }}</p>
                                @else
                                    <p><strong>Date d&apos;intégration :</strong> {{ $demande->dateIntegration }} <span class="text-xs">(JJ/MM/AAAA)</span></p>
                                    <p><strong>Date de départ à la retraite :</strong> {{ $demande->dateDepartARetraite }} </p>
                                    <p><strong>Direction :</strong> {{ $demande->direction }}</p>
                                    <p><strong>Service :</strong> {{ $demande->service }}</p>
                                @endif
                            </div>
                            
                            
                            
                        </div>
                    @endif
                </div>

        
                {{-- <!-- Modifier les informations --> --}}
                {{-- <div class=" flex justify-between text-right mt-6">
                    <a href="{{ route('demandes.edit', $demande->id) }}">

                        <button class="btn">
                            <i class=" fa fa-pencil mr-2"></i>
                            Compléter les informations
                        </button>
                    </a>
                  
                </div> --}}
                <div class=" flex justify-between text-right mt-6">
                    {{-- <a href="{{ route('demandes.edit', $demande->id) }}">

                        <button class="btn">
                            <i class=" fa fa-pencil mr-2"></i>
                            Modifier les informations
                        </button>
                    </a> --}}
                    @if ($demande->etat === 0)
                        <form action="{{ route('demandes.destroy', $demande->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                            @csrf
                            @method('DELETE') <!-- Cette ligne simule une requête DELETE -->
                            <button type="submit" class="btn bg-red-700">
                                <i class="fa fa-times mr-2"></i>
                                Rejeter
                            </button>
                        </form>
                    
                        
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            function confirmDeletion(id) {
                                Swal.fire({
                                    title: 'Êtes-vous sûr ?',
                                    text: "Vous ne pourrez pas annuler cette action !",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Oui, rejeter !',
                                    cancelButtonText: 'Annuler'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById(`delete-form-${id}`).submit();
                                    }
                                });
                            }
                        </script>
                    
                        <form action="{{ route('adherents.accept', $demande->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn">
                                <i class=" fa fa-check mr-2"></i>

                                Approuver
                            </button>
                        </form>
                       
                    @else
                        
                        <i class="fa fa-check-circle text-green-600"></i>
                    @endif
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
    </x-content-page-admin>
</x-app-layout>


