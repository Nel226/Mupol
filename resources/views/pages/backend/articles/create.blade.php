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
                    
                    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre</label>
                            <input type="text" name="titre" id="titre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Titre de l'article" required>
                            @error('titre')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    
                       
                        <!-- Categorie -->
                        <div class="grid grid-cols-1 sm:grid-cols-3">
                            <div class=" col-span-2 text-xs">
                                <label class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Catégorie</label>
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <input type="radio" id="categorie_sante" name="categorie" value="Santé"  required>
                                        <label for="categorie_sante" class="text-sm text-gray-900 dark:text-white">Santé</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="categorie_social" name="categorie" value="Social"  required>
                                        <label for="categorie_social" class="text-sm text-gray-900 dark:text-white">Social</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="categorie_administration" name="categorie" value="Administration"  required>
                                        <label for="categorie_administration" class="text-sm text-gray-900 dark:text-white">Administration</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="categorie_sport" name="categorie" value="Sport"  required>
                                        <label for="categorie_sport" class="text-sm text-gray-900 dark:text-white">Sport</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="categorie_divers" name="categorie" value="Divers"  required>
                                        <label for="categorie_divers" class="text-sm text-gray-900 dark:text-white">Divers</label>
                                    </div>
                                </div>
                                @error('categorie')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div> 
                            <div class="col-span-1">

                                <label for="date" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required>
                                @error('date')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <!-- Photo -->
                        <div class="col-span-2">
                            <label for="image_principal" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Photo principale</label>
                            <div id="uploadPhoto" class="flex flex-col h-full shadow-sm">
                              <div class="border-dashed border-2 border-gray-300 rounded-md p-1 flex-grow flex justify-center items-center">
                                  <div class="text-center w-full h-full text-xs">
                                      <img id="previewImage" class="w-full h-auto  max-h-72 object-cover mb-4" src="default-image.jpg" alt="Aperçu de l'image" />
                                      
                                      <p class="text-gray-500">Déposez votre image ici ou</p>
                                      <label for="image_principal" class="cursor-pointer text-blue-500 hover:underline">
                                          cliquez pour choisir une image
                                      </label>
                                      <input type="file" id="image_principal" class="hidden" accept="image/*" name="image_principal">
                                  </div>
                              </div>
                            </div>
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const fileInput = document.getElementById('image_principal');
                                    const previewImage = document.getElementById('previewImage');
                                    const defaultImage = "{{ asset('images/default-image.jpg') }}"; // Chemin correct

                                    previewImage.src = defaultImage;

                                    fileInput.addEventListener('change', function () {
                                        const file = this.files[0];
                            
                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = function (e) {
                                                previewImage.src = e.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        } else {
                                            // Remettre l'image par défaut si aucun fichier n'est sélectionné
                                            previewImage.src = defaultImage;
                                        }
                                    });
                                });
                            </script>
                            @error('image_principal')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                        </div>
                        <!-- resume -->
                        <div class="col-span-2">
                            <label for="resume" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Résumé</label>
                            <textarea type="text" name="resume" id="resume"  class="bg-gray-50  border border-gray-300 text-gray-900  rounded-lg text-sm block w-full  dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                            </textarea> 

                            @error('resume')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                           
                        </div>
                        <!-- CONTENU -->
                        <div class="col-span-2">
                            <label for="contenu" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Contenu</label>
                            <textarea type="text" name="contenu" id="editor2"  class="bg-gray-50  border border-gray-300 text-gray-900  rounded-lg text-sm block w-full  dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                            </textarea> 

                            @error('contenu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                           
                        </div>


                        <script src="{{ asset('js/ckeditor_4.22.1_standard/ckeditor.js') }} "></script>
                        <script>
                          CKEDITOR.replace( 'editor2', {
                            filebrowserBrowseUrl: "{{ asset('js/ckfinder/ckfinder.html') }}",
                            filebrowserUploadUrl: "{{ asset('js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}"
                          } );
                           
                        </script>
 
                      
                        <div class="flex justify-end">
                            <button type="submit" class="btn mt-5 ">
                                Publier
                            </button>

                        </div>
                    </form>

                   
                
                </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>



