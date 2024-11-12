<x-guest-layout class="main-container">
    <style>
        .main-container {
            display: flex;
            flex-direction: row;
            min-height: 100vh; /* Assurez-vous que la page prend toute la hauteur */
        }
    </style>
    <x-header-guest/>
    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                
                setTimeout(() => {
                    notification.classList.add('hidden'); // Cache le message après 5 secondes
                }, 5000);
            });
        </script>
    @endif
    @if (Auth::guard('adherent')->user()->is_adherent === 0)
    <div class=" h-screen">

		<section class="contact-us section">
			<div class="container">
				<div class="inner">
					<div class="row d-flex justify-content-center"> 
						
						<div class="col-lg-6  col-md-8 col-12 mx-auto">
							<div class="contact-us-form  bg-green-100 border border-green-400 text-green-700">
								<h2 class=" !text-xl">Votre demande d&apos;adhésion a été bien reçue !</h2>
								<p class=" text-justify">Elle est en cours de traitement. Veuillez contacter le <strong>+226 25434532</strong>  si vous ne recevez pas de réponse dans les <strong>72 heures (jours ouvrables)</strong> qui suivent votre demande. </p>
                             
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</section>
	
    </div>
    @else
        {{--  <x-preloader/>  --}}
        <x-sidebar-guest/>
        <div class=" content">
            <style>
                .content {
                    padding: 1rem;
                }
            </style>
            <section class="section">
                <div class="container h-screen">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                          
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
</x-guest-layout>
