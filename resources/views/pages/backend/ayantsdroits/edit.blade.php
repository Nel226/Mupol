

<x-app-layout >
    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
    </x-succes-notification>
    
    @endif
    <x-top-navbar-admin/>

    <div id="sidebar" class="lg:block z-20 hidden  bg-blue-800  w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" class="" />
    
    </div>
   
    <x-content-page-admin>
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
        <x-header>
            {{$pageTitle}}
        </x-header>
        <div class="md:p-6 p-2 mx-auto  mt-4 bg-white rounded-lg shadow-lg ">
           
            <div class="w-5/6 mx-auto">
                <h2 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Modifier les informations de l&apos;ayant droit</h2>
                <form action="{{ route('ayantsdroits.update', $ayantDroit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <dl class="grid gap-3 mb-2 grid-cols-1 text-primary1">

                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Code carte :</dt>
                            <dd class="text-sm font-semibold  dark:text-gray-300">
                                {{ old('code', $ayantDroit->code) }}
                            </dd>
                        </div>
                    </dl>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        
                        
                        <div class="w-full">
                            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $ayantDroit->nom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le nom de l'ayant droit" required>
                        </div>
                        <div class="w-full">
                            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $ayantDroit->prenom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-primary-500" placeholder="Entrez le prénom de l'ayant droit" required>
                        </div>
                        <div class="w-full">
                            <label for="date_naissance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $ayantDroit->date_naissance) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>
                        <div class="w-full">
                            <label for="sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                            <div id="sexe" class="flex items-center p-2 space-x-4">
                                <label class="inline-flex items-center text-gray-700 dark:text-white">
                                    <input type="radio" name="sexe" value="M" {{ strtoupper($ayantDroit->sexe[0]) == 'M' ? 'checked' : '' }} class="text-primary1 form-radio">
                                    <span class="ml-2 text-sm">Masculin</span>
                                </label>
                                <label class="inline-flex items-center text-gray-700 dark:text-white">
                                    <input type="radio" name="sexe" value="F" {{ strtoupper($ayantDroit->sexe[0]) == 'F' ? 'checked' : '' }} class="text-primary1 form-radio">
                                    <span class="ml-2 text-sm">Féminin</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="w-full">
                            <label for="relation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relation</label>
                            <select id="relation" name="relation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled {{ old('position', $ayantDroit->position) ? '' : 'selected' }}>
                                    Sélectionnez une relation
                                </option>
                                <option value="Enfant" {{ $ayantDroit->relation == 'Enfant' ? 'selected' : '' }}>Enfant</option>
                                <option value="Conjoint(e)" {{ $ayantDroit->relation == 'Conjoint(e)' ? 'selected' : '' }}>Conjoint(e)</option>
                            </select>
                        </div>
                       
                        <div class="w-full">
                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code carte</label>
                            <select id="position" name="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled {{ old('position', $ayantDroit->position) ? '' : 'selected' }}>
                                    Sélectionnez une position
                                </option>
                        
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" 
                                        {{ old('position', $ayantDroit->position) == $i ? 'selected' : '' }}>
                                        {{ $ayantDroit->adherent->matricule }}/0{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>


                    

                    <div class="flex items-end justify-end mt-8">
                        <x-primary-button type="submit" class="">
                            Mettre à jour l&apos;ayant droit
                        </x-primary-button>
                    </div>
                </form>
               
            </div>
            
        </div>
    </x-content-page-admin>
    
</x-app-layout>
