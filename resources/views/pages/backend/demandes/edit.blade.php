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
        
        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            @role('agentsaisie|controleur')
                
                <div class="mx-auto md:w-3/4">
                    <h2 class="mb-4 md:text-lg font-bold text-gray-900 dark:text-white">Modifier les informations de la demande de création de compte</h2>
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

                    <form method="POST" action="{{ route('demandes.update', $demande->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                            <!-- Nom adhérent -->
                            <div>
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('nom', $demande->nom) }}" required>
                                @error('nom')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Prénom -->
                            <div>
                                <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('prenom', $demande->prenom) }}" required>
                                @error('prenom')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Matricule -->
                            <div>
                                <label for="matricule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N° Matricule</label>
                                <input type="number" name="matricule" id="matricule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Matricule" value="{{ old('matricule', $demande->matricule) }}" required>
                                @error('matricule')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Téléphone -->
                            <div>
                                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                <input type="number" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de téléphone" value="{{ old('telephone', $demande->telephone) }}" required>
                                @error('telephone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Email de l'adhérent" value="{{ old('email', $demande->email) }}" required>
                                @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Photo -->
                            <div class="md:col-span-2">
                                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                                <div class="mt-4 w-full md:w-1/2 mx-auto">
                                    <img id="preview" 
                                        src="{{ $demande->photo ? asset('storage/'.$demande->photo) : '' }}" 
                                        alt="Prévisualisation de l'image" 
                                        class="w-full max-w-md mx-auto h-auto border border-gray-300 rounded-lg">
                                </div>
                            </div>
                        
                            <!-- Bouton de soumission -->
                            <div class="md:col-span-2 flex mt-5 justify-end">
                                
                                <button type="submit" class="btn">
                                    Valider
                                </button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>




