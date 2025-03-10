
<x-guest-layout>
    <x-preloader/>
    <x-header-guest/>
    
    <div class="container mx-auto px-4">
        <section class="contact-us section">
            <div class="container">
                <div class="inner">
                    <div class="row d-flex justify-content-center"> 
                       
                        <div class="col-lg-6 col-md-8 col-12 mx-auto">
                            <div class="contact-us-form">
                                <h2 class="!text-xl">Mot de passe oublié</h2>
                                <p>Veuillez saisir votre adresse email de compte.</p>
                                @if (session('status'))
                                    <div class="bg-green-100 text-green-700 p-3 rounded mb-3">{{ session('status') }}</div>
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

                                <form class="form" action="{{ route('all-users.password.email') }}" method="POST">
                                    @csrf

                                    <div class="row justify-center mx-auto">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="block font-medium text-gray-700">Adresse email</label>
                                                <input type="email" name="email" id="email" 
                                                        required autocomplete="off"
                                                       class="bg-gray-50 border !text-sm !lowercase w-full">
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

