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
								<h2 class=" !text-xl">Changez votre mot de passe</h2>
								<p>Veuillez définir un nouveau mot de passe personnel. Prenez garde à ne pas le partager.</p>
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
                                <form class="form" action="{{ route('adherents.change-password') }}" method="POST">
                                    @csrf
                                    <div class="row justify-center mx-auto">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password" class="block font-medium text-gray-700">Nouveau mot de passe</label>
                                                <input 
                                                    class="bg-gray-50 border" 
                                                    type="password" 
                                                    name="password" 
                                                    id="password" 
                                                    placeholder="Mot de passe" 
                                                    required 
                                                    minlength="8"
                                                >
                                                
                                                <!-- Liste des critères -->
                                                <ul id="password-requirements" class="mt-2 text-gray-600">
                                                    <li id="min-characters" class="requirement">✔️ Au moins 8 caractères</li>
                                                    <li id="uppercase" class="requirement">✔️ Au moins une lettre majuscule</li>
                                                    <li id="lowercase" class="requirement">✔️ Au moins une lettre minuscule</li>
                                                    <li id="number" class="requirement">✔️ Au moins un chiffre</li>
                                                    <li id="special-char" class="requirement">✔️ Au moins un caractère spécial (@, $, !, %, *, ?, &)</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password_confirmation" class="block font-medium text-gray-700">Confirmer le mot de passe</label>
                                                <input 
                                                    class="bg-gray-50 border" 
                                                    type="password" 
                                                    name="password_confirmation" 
                                                    id="password_confirmation" 
                                                    placeholder="Confirmez votre mot de passe" 
                                                    required 
                                                    minlength="8"
                                                >
                                                <div id="password-match" class="text-sm mt-1"></div>
                                            </div>

                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group login-btn">
                                                <button class="btn" type="submit">
                                                    Mettre à jour le mot de passe
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <style>
                                    .requirement {
                                        color: #d9534f; /* Rouge par défaut */
                                    }
                                    .requirement.valid {
                                        color: #5cb85c; /* Vert lorsqu'il est valide */
                                        font-weight: bold;
                                    }
                                    #password-match.valid {
                                        color: #5cb85c; /* Vert pour valide */
                                    }
                                    #password-match.invalid {
                                        color: #d9534f; /* Rouge pour non-valide */
                                    }

                                    
                                </style>  
                                <script>
                                    document.getElementById('password').addEventListener('input', function() {
                                        const password = this.value;
                                        
                                        // Sélecteurs des éléments de la liste des critères
                                        const minCharacters = document.getElementById('min-characters');
                                        const uppercase = document.getElementById('uppercase');
                                        const lowercase = document.getElementById('lowercase');
                                        const number = document.getElementById('number');
                                        const specialChar = document.getElementById('special-char');
                                        
                                        // Vérifier chaque critère et appliquer la classe 'valid' si le critère est rempli
                                        password.length >= 8 ? minCharacters.classList.add('valid') : minCharacters.classList.remove('valid');
                                        /[A-Z]/.test(password) ? uppercase.classList.add('valid') : uppercase.classList.remove('valid');
                                        /[a-z]/.test(password) ? lowercase.classList.add('valid') : lowercase.classList.remove('valid');
                                        /\d/.test(password) ? number.classList.add('valid') : number.classList.remove('valid');
                                        /[@$!%*?&]/.test(password) ? specialChar.classList.add('valid') : specialChar.classList.remove('valid');
                                    });
                                </script>
                                <script>
                                    // Sélecteurs pour le champ mot de passe, confirmation et message de correspondance
                                    const passwordField = document.getElementById('password');
                                    const passwordConfirmationField = document.getElementById('password_confirmation');
                                    const passwordMatchMessage = document.getElementById('password-match');
                                    
                                    // Fonction de vérification de la correspondance des mots de passe
                                    function checkPasswordMatch() {
                                        const password = passwordField.value;
                                        const confirmation = passwordConfirmationField.value;
                                        
                                        // Vérifier si les deux champs correspondent
                                        if (password === confirmation && password.length >= 8) {
                                            passwordMatchMessage.textContent = "✔️ Les mots de passe correspondent";
                                            passwordMatchMessage.classList.add('valid');
                                            passwordMatchMessage.classList.remove('invalid');
                                        } else {
                                            passwordMatchMessage.textContent = "❌ Les mots de passe ne correspondent pas";
                                            passwordMatchMessage.classList.add('invalid');
                                            passwordMatchMessage.classList.remove('valid');
                                        }
                                    }
                                
                                    // Attacher l'événement 'input' aux deux champs pour la vérification en temps réel
                                    passwordField.addEventListener('input', checkPasswordMatch);
                                    passwordConfirmationField.addEventListener('input', checkPasswordMatch);
                                </script>
                                                         
                                
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</section>
	
    </div>
</x-guest-layout>
