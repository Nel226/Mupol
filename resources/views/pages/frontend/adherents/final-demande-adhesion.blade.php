<x-guest-layout>
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
       

        <div class="flex justify-end gap-2 my-3">
            <img src="{{ $demandeAdhesion->signature}}" alt="">
            <a href="{{ route('download-fiche-cession-volontaire', [
                    'id' => $demandeAdhesion->id, 
                ]) }}">
                <x-primary-button>
                    Télécharger la fiche de cession volontaire
                </x-primary-button>

            </a>

            <x-primary-button onclick="printIframe('iframeId')" style="background-color: #4CAF50; color: white; border: none; cursor: pointer;">
                Imprimer 
            </x-primary-button>
        </div>
        <div class="container  my-3 border border-gray-200  p-10 bg-white shadow-lg rounded-lg mx-auto">
            <script>
                function printIframe(iframeId) {
                    var iframe = document.getElementById(iframeId);
                    if (iframe) {
                        var iframeWindow = iframe.contentWindow || iframe; 
                        iframeWindow.focus(); 
                        iframeWindow.print(); 
                    } else {
                        console.error("L'iframe avec l'ID '" + iframeId + "' est introuvable.");
                    }
                }
        
                document.addEventListener("DOMContentLoaded", function() {
                    var iframe = document.getElementById('iframeId'); 
                    iframe.onload = function() {
                        console.log("Iframe chargé.");
                    };
                });
            </script>

            <div class="font-bold mb-4 text-green-600 flex-col text-center justify-center space-y-2 ">
               <i class="fa fa-check-circle w-16 h-16 text-5xl"></i>
                <h4>Votre demande a bien été enregistrée</h4>
            </div>
            <p class=" text-center">Un email de confirmation vous a été transmis à l&apos;adresse : {{$demandeAdhesion->email}}, Veuillez le consulter.</p>
        
        </div>
    </x-section-guest>
</x-guest-layout>