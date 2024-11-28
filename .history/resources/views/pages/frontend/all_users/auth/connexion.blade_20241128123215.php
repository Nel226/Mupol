

<x-guest-layout>
    <x-preloader/>
    <x-header-guest/>
    <div class="">
       
        <section class="section ">
            <div class="container ">
                <div class="">
                    <div class="row  mx-auto justify-center">
                        <!-- Left: Image -->
                        <div class="w-1/2 hidden lg:block " style="background: rgb(75,68,220);
                            background: linear-gradient(90deg, #c9ccee 9%, #f2f2f9 85%);">
                            <div class=" mx-auto justify-center flex h-full items-center ">
                                <div class="rounded-full !w-[30%] ">
                                    <x-application-logo class=" mx-auto" />
    
                                </div>
                            </div>
                        </div>
                        <!-- Right: Login Form -->
                        <div class="lg:p-26 md:p-42 sm:10 p-8   w-full lg:w-1/2 bg-gray-50">
                        <h1 class="text-2xl font-semibold mb-4">Connexion</h1>
                        <!-- Error Display -->
                            @if ($errors->any())
                                <div class="mb-4 justify-center mx-auto text-center text-red-600">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
        
                            <form method="POST" action="{{ route('user.login') }}" class=" space-y-4">
                                @csrf
                                <label for="email" class="block text-gray-600">Email</label>
                                <div class="relative flex items-center">
                                    
                                    <input name="email" type="text" required
                                    class="w-full text-sm text-gray-800 bg-white border-2 border-transparent focus:border-[#1E2772] px-4 py-3 rounded-md outline-none"
                                    placeholder="Entrez votre email" />
                                    <i class="fa fa-envelope absolute right-4 text-gray-400"></i>
                                </div>
                                <label for="password" class="block text-gray-600">Mot de passe</label>
                                <div class="relative flex items-center">
                                    
                                    <input id="password" name="password" type="password" required
                                    class="w-full text-sm text-gray-800 bg-white border-2 border-transparent focus:border-[#1E2772] px-4 py-3 rounded-md outline-none"
                                    placeholder="Entrez votre mot de passe" />
    
                                    <i class="fa fa-eye absolute right-4 text-gray-400 cursor-pointer" onclick="togglePasswordVisibility()"></i>
                                </div>
                                <script>
                                    function togglePasswordVisibility() {
                                        const passwordInput = document.getElementById("password");
                                        const icon = passwordInput.nextElementSibling;
                                    
                                        if (passwordInput.type === "password") {
                                            passwordInput.type = "text";
                                            icon.classList.remove("fa-eye");
                                            icon.classList.add("fa-eye-slash");
                                        } else {
                                            passwordInput.type = "password";
                                            icon.classList.remove("fa-eye-slash");
                                            icon.classList.add("fa-eye");
                                        }
                                    }
                                </script>
                            
                                
                                {{-- <!-- Forgot Password Link -->
                                <div class="mb-6 text-primary1">
                                    <a href="{{ route('password.request') }}" class="hover:underline">Mot de passe oublié?</a>
                                </div> --}}
                                <!-- Login Button -->
                                <x-primary-button type="submit"
                                    class="w-full !justify-center px-4 !py-2.5 text-base font-semibold rounded-md !text-white  focus:outline-none">
                                    Se connecter
                                </x-primary-button>
                            </form>
                            <!-- Sign up  Link -->
                            <div class="mt-6 text-primary1 text-center">
                                <a href="{{ route('formulaire-adhesion') }}" class="hover:underline">Adhérer maintenant</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-guest-layout>
