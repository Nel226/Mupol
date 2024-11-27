
<x-guest-layout>
    <x-preloader/>  
    <x-header-guest/>
    <div class="">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
		<section class="contact-us section">
			<div class="container">
				<div class="inner">
					<div class="row d-flex justify-content-center"> 
						
						<div class="col-lg-6  col-md-8 col-12 mx-auto">
							<div class="contact-us-form">
								<h2 class=" !text-xl">Réinitialiser votre mot de passe</h2>
								<p>Veuillez saisir votre adresse e-mail, le lien de réinitialisation vous y sera envoyé.</p>
                                @if (session('status'))
                                    <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="row justify-center mx-auto">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="block font-medium text-gray-700">Adresse email</label>
                                                <input class="bg-gray-50 border !text-sm !lowercase"  type="email"  name="email"    id="email"   placeholder="Entrez votre adresse email"  required autocomplete="off">
                                                
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-12">
                                            <div class="form-group login-btn">
                                                <x-primary-button class="btn">
                                                    {{ __('Envoyer le lien de réinitialisation') }}
                                                </x-primary-button>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </form>
                                                         
                                
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</section>
	
    </div>
</x-guest-layout>


