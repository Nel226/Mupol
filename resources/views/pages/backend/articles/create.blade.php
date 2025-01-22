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
            @role('communitymanager')
                <div class="md:w-3/4 mx-auto">
                    <h2 class="mb-4 text-sm md:text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Créer un nouvel article</h2>
                    
                    <form method="POST" action="{{ route('partenaires.store') }}" enctype="multipart/form-data">
                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="titre" id="titre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Titre de l\'article" required>
                            @error('titre')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Categories -->
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="" disabled selected>Sélectionnez le type de partenaire</option>
                                <option value="hopital">Hôpital</option>
                                <option value="clinique">Clinique</option>
                                <option value="pharmacie">Pharmacie</option>
                                <option value="laboratoire">Laboratoire d&apos;analyses médicales</option>
                                <option value="opticien">Opticien</option>
                                <option value="dentaire">Cabinet dentaire</option>
                                <option value="autre">Autre</option>

                            </select>
                            @error('type')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> Image </label>
                            <div class="input-group">
                              
                              <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                  Browse <input type="file" name="bimgs" multiple>
                                </span>
                               </span>
                              <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <style>
                            .btn-file {
                                position: relative;
                                overflow: hidden;
                            }
                            
                            .btn-file input[type=file] {
                                position: absolute;
                                top: 0;
                                right: 0;
                                min-width: 100%;
                                min-height: 100%;
                                font-size: 100px;
                                text-align: right;
                                filter: alpha(opacity=0);
                                opacity: 0;
                                outline: none;
                                background: white;
                                cursor: inherit;
                                display: block;
                            }

                            .btn-file {
                                position: relative;
                                overflow: hidden;
                            }
                            
                            .btn-file input[type=file] {
                                position: absolute;
                                top: 0;
                                right: 0;
                                min-width: 100%;
                                min-height: 100%;
                                font-size: 100px;
                                text-align: right;
                                filter: alpha(opacity=0);
                                opacity: 0;
                                outline: none;
                                background: white;
                                cursor: inherit;
                                display: block;
                            }
                            
                            input[readonly] {
                              background-color: white !important;
                              cursor: text !important;
                            }
                            
                            /* this is only due to codepen display don't use this outside of codepen */
                            .container {
                              padding-top: 20px;
                            }
                            
                        </style>

                        <div class="container">
                            <div class="row">
                              <div class="col-md-12">
                                <form method="post" role="form">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="title" placeholder="Title"/>
                                  </div>
                                  <div class="form-group">
                                    <label> Image </label>
                                    <div class="input-group">
                                      
                                      <span class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                          Browse <input type="file" name="bimgs" multiple>
                                        </span>
                                       </span>
                                      <input type="text" class="form-control" readonly>
                                     </div>
                                  </div>
                                  <div class="form-group">
                                    <textarea class="form-control bcontent" name="content"></textarea>
                                  </div>
                                  <div class="form-group">
                                     <input type="submit" name="Submit" value="Publish" class="btn btn-primary form-control" />
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>

                        <!-- Photo -->
                        <div class="col-span-2">
                            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('photo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="mt-4">
                                <img id="preview" src="#" alt="Prévisualisation de l'image" class="hidden max-w-full h-auto border border-gray-300 rounded-lg">
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="btn mt-5 ">
                                Ajouter partenaire
                            </button>

                        </div>
                    </form>
                </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>



