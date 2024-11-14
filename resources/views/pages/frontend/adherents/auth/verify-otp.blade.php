
<x-guest-layout>
    <x-preloader/>  
    <x-header-guest/>
    <div class="">

		<section class="contact-us section">
			<div class="container">
				<div class="inner">
					<div class="row d-flex justify-content-center"> 
						
						<div class="col-lg-6  col-md-8 col-12 mx-auto">
							<div class="contact-us-form">
								<h2 class=" !text-xl">Vérifiez votre OTP</h2>
								<p>Veuillez saisir votre code OTP reçu par e-mail.</p>
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
                                <form class="form" action="{{ route('adherents.verify-otp') }}" method="POST">
                                    @csrf
                                    <div class="row justify-center mx-auto">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="otp" class="block font-medium text-gray-700">Code OTP</label>
                                                <input class="bg-gray-50 border"  type="number"  name="otp"    id="otp"   placeholder="Code OTP"  required>
                                                @error('otp')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-12">
                                            <div class="form-group login-btn">
                                                <button class="btn" type="submit">
                                                    Vérifier
                                                </button>
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
