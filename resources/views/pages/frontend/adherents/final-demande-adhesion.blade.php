<x-guest-layout>
    <x-preloader/>
    <x-header-guest/>
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
            
    <section class=" section">
        <div class="container">
            <div class="">
                <div class="row "> 
                    <div class="col-lg-12">
                        <x-section-guest>

                            <div class="flex justify-between gap-2 my-3">
                                <a class="btn" href="{{ route('download-form-adhesion', ['id' => $demandeAdhesion->id]) }}">
                                    Télécharger le formulaire d'adhésion
                                </a>

                                <div>
                                    <a class="btn" href="{{ route('download-fiche-cession-volontaire', ['id' => $demandeAdhesion->id]) }}">
                                        Télécharger la fiche de cession volontaire
                                    </a>
                                    
                                </div>
                            </div>
                            
                            {{-- <iframe id="iframeId" src="{{ route('imprimer-fiche-cession', ['id' => $demandeAdhesion->id]) }}" style="display:none;"></iframe>
                            
                            <script>
                                function printIframeContent() {
                                    const iframe = document.getElementById('iframeId');
                                    iframe.contentWindow.focus(); 
                                    iframe.contentWindow.print();  
                                }
                            </script> --}}
                            <div class="container  my-3 border border-gray-200  p-10 bg-white shadow-lg rounded-lg mx-auto">
                                <div class="font-bold mb-4 text-green-600 flex-col text-center justify-center space-y-2 ">
                                    <i class="fa fa-check-circle w-16 h-16 text-5xl"></i>
                                    <h4>Votre demande a bien été enregistrée</h4>
                                </div>
                                <p class=" text-center">Un email de confirmation vous a été transmis à l&apos;adresse : {{$demandeAdhesion->email}}, Veuillez le consulter.</p>
                            </div>
                        </x-section-guest>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>



