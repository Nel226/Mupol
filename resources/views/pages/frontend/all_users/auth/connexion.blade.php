
<style>
    .svg-icon {
        max-width: 100%;
        height: auto;
        display: inline-block;
    }
</style>
<x-guest-layout>
    <x-header-guest/>
    <x-preloader/>
    <div class="">
        {{--  <!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Demande d&apos;adhésion MU-POL</h2>
							<ul class="bread-list">
								<li><a href="index.html">Accueil</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Adhérer</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->  --}}

        <section class="section">
            <div class="container h-screen">
                <div class="">
                    <div class="row  mx-auto justify-center">
                        <div class="col-lg-10  flex justify-center rounded-lg">
                            <div class=" bg-[#4B45DC  max-w-md w-full mx-auto border p-8 shadow-lg rounded-tl-lg rounded-bl-lg " style="background: rgb(75,68,220);
                            background: linear-gradient(90deg, #c9ccee 9%, #f2f2f9 85%);">
                                <div class=" mx-auto justify-center flex h-full items-center ">
                                    <div class="rounded-full !w-[30%] ">
                                        <x-application-logo class=" mx-auto" />

                                    </div>
                                </div>
                            </div>
                            <div class="max-w-md w-full mx-auto border p-8 rounded-tr-lg rounded-br-lg bg-gray-200">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 612" fill="#556080" height="100px" width="100px" class=" inline-block">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M331.685,425.378c-7.478,7.479-7.478,19.584,0,27.043c7.479,7.478,19.584,7.478,27.043,0l131.943-131.962
                                                    c3.979-3.979,5.681-9.276,5.412-14.479c0.269-5.221-1.434-10.499-5.412-14.477L358.728,159.56
                                                    c-7.459-7.478-19.584-7.478-27.043,0c-7.478,7.478-7.478,19.584,0,27.042l100.272,100.272H19.125C8.568,286.875,0,295.443,0,306
                                                    c0,10.557,8.568,19.125,19.125,19.125h412.832L331.685,425.378z M535.5,38.25H153c-42.247,0-76.5,34.253-76.5,76.5v76.5h38.25
                                                    v-76.5c0-21.114,17.117-38.25,38.25-38.25h382.5c21.133,0,38.25,17.136,38.25,38.25v382.5c0,21.114-17.117,38.25-38.25,38.25H153
                                                    c-21.133,0-38.25-17.117-38.25-38.25v-76.5H76.5v76.5c0,42.247,34.253,76.5,76.5,76.5h382.5c42.247,0,76.5-34.253,76.5-76.5
                                                    v-382.5C612,72.503,577.747,38.25,535.5,38.25z" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>

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
    
                                <form method="POST" action="{{ route('user.login') }}" class="mt-12 space-y-4">
                                    @csrf
                                    <div class="relative flex items-center">
                                        <input name="email" type="text" required
                                            class="w-full text-sm text-gray-800 bg-white border-2 border-transparent focus:border-[#1E2772] px-4 py-3 rounded-md outline-none"
                                            placeholder="Entrez votre email" />
                                        <i class="fa fa-envelope absolute right-4 text-gray-400"></i>
                                    </div>
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
                                    
                                    <div class="!mt-12 !text-center">
                                        <x-primary-button type="submit"
                                            class="w-full !justify-center px-4 !py-2.5 text-base font-semibold rounded-md !text-white  focus:outline-none">
                                            Se connecter
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
