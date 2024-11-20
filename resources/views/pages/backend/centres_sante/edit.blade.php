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
        @section('navigation-content')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" :pageTitle="$pageTitle"/>
        @endsection       

        <div class="flex-1 p-6">
            <x-header>
                {{$pageTitle}}
            </x-header>
            
            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg">
                <div class="w-3/4 mx-auto">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier le centre de santé</h2>
                    
                    <form method="POST" action="{{ route('centres-sante.update', $centre->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <div class="grid gap-3 sm:grid-cols-2 sm:gap-6">
                            

                            <!-- Nom du centre de santé -->
                            <div class="w-full">
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom du centre de santé" value="{{ old('nom', $centre->nom) }}" required>
                                @error('nom')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type du centre de santé -->
                            <div class="w-full">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="hopital" {{ old('type', $centre->type) == 'hopital' ? 'selected' : '' }}>Hôpital</option>
                                    <option value="clinique" {{ old('type', $centre->type) == 'clinique' ? 'selected' : '' }}>Clinique</option>
                                </select>
                                @error('type')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Adresse -->
                            <div class="w-full col-span-2">
                                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                <textarea name="adresse" id="adresse" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Adresse du centre" required>{{ old('adresse', $centre->adresse) }}</textarea>
                                @error('adresse')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="w-full">
                                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                <input type="number" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de téléphone" value="{{ old('telephone', $centre->telephone) }}" required>
                                @error('telephone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Email du centre" value="{{ old('email', $centre->email) }}" required>
                                @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Région -->
                            <div class="w-full">
                                <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Région</label>
                                <select name="region" id="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Sélectionnez une région</option>
                                </select>
                                @error('region')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Province -->
                            <div class="w-full">
                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                <select name="province" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Choisissez d&apos;abord votre région</option>
                                </select>
                                @error('province')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Photo du centre -->
                            <div class="w-full col-span-2">
                                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo du centre</label>
                                <input type="file" name="photo" id="photo" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('photo')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div class="mt-4">
                                    <img id="preview" src="{{ $centre->photo ? asset('storage/photos/centres-sante/'.$centre->photo) : '' }}" alt="Prévisualisation de l'image" class="max-w-full h-auto border border-gray-300 rounded-lg">
                                </div>
                            </div>

                            <p>{{ asset('storage/photos/centres-sante/'.$centre->photo) }}</p>

                            <script>
                                document.getElementById('photo').addEventListener('change', function(event) {
                                    const file = event.target.files[0];
                                    const reader = new FileReader();
                                    const preview = document.getElementById('preview');
                            

                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.classList.remove('hidden');
                                    }
                                    
                                    if (file) {
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
                            
                            <div class="flex justify-end">
                                <x-primary-button type="submit" class="mt-5 ">
                                    Modifier le centre de santé
                                </x-primary-button>
    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-content-page>
</x-app-layout>
