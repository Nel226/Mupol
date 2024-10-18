<x-guest-layout>
    @livewire('image-preview')

    <x-header-guest/>
    <x-section-guest>
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

        
        
        
        {{-- <canvas id= "signatureCanvas" width= "400" height= "200" ></canvas>
        <button id= "saveButton" >Enregistrer</button>
        <script>
            const canvas = document.querySelector(' #signatureCanvas ');
            const signaturePad = new SignaturePad(canvas);
            const saveButton = document.querySelector(' #saveButton '); 
            saveButton.addEventListener(' clic ', function () {});
            // Obtenir l'image de signature sous forme d'URL de données codées en Base64. 

        </script> --}}
        <div class="container max-w-4xl my-3  p-10 bg-white shadow-lg rounded-lg mx-auto">
            <div class="flex justify-between my-3">
                <a href="{{ route('download-fiche-cession-volontaire', ['id' => $demandeAdhesion->id]) }}" >
                    <x-primary-button>
                        Télécharger cession volontaire
                    </x-primary-button>
                </a>
                <x-primary-button onclick="printIframe('iframeId')" style="background-color: #4CAF50; color: white; border: none; cursor: pointer;">
                    Imprimer 
                </x-primary-button>
            </div>
            <script>
                function printIframe(iframeId) {
                    var iframe = document.getElementById(iframeId);
                    if (iframe) {
                        var iframeWindow = iframe.contentWindow || iframe; // Access to the iframe's window object
                        iframeWindow.focus(); // Focus the iframe
                        iframeWindow.print(); // Trigger the print dialog for the iframe
                    } else {
                        console.error("L'iframe avec l'ID '" + iframeId + "' est introuvable.");
                    }
                }
        
                // Optionnel : Écouter le chargement complet de l'iframe avant d'activer le bouton d'impression
                document.addEventListener("DOMContentLoaded", function() {
                    var iframe = document.getElementById('iframeId'); // Utilisez ici l'ID correct
                    iframe.onload = function() {
                        console.log("Iframe chargé.");
                    };
                });
            </script>
            <h1 class="text-xl font-bold mb-4">Aperçu fiche de cession volontaire de salaire</h1>

            <div class="relative h-0 pb-[141.42%] shadow-lg">
                <iframe id="iframeId"
                    class="absolute inset-0 w-full h-full border-4 border-gray-500" 
                    src="{{ route('showCessionVolontaire', ['id' => $demandeAdhesion->id]) }}" 
                    allowfullscreen 
                    title="Fiche de cession volontaire de salaire"
                    aria-hidden="false" 
                    tabindex="0">
                </iframe>
            </div>
        
        </div>
    </x-section-guest>
</x-guest-layout>