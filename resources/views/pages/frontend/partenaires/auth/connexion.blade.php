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
                                   <svg fill="#556080" height="130px" width="130px" class=" inline-block" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-56.32 -56.32 624.64 624.64" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M501.801,148.348H388.739V30.172c0-5.633-4.567-10.199-10.199-10.199H133.462c-5.633,0-10.199,4.566-10.199,10.199 v118.176H10.199C4.566,148.348,0,152.915,0,158.548v323.28c0,5.633,4.566,10.199,10.199,10.199h491.602 c5.632,0,10.199-4.566,10.199-10.199v-323.28C512,152.915,507.433,148.348,501.801,148.348z M123.262,471.628H20.398V168.747 h102.864V471.628z M293.689,471.628h-27.49v-27.831c0-5.633-4.567-10.199-10.199-10.199c-5.633,0-10.199,4.566-10.199,10.199 v27.831h-27.49v-76.788h75.378V471.628z M368.34,471.629h-54.253v0v-86.987c0-5.633-4.567-10.199-10.199-10.199h-95.777 c-5.633,0-10.199,4.566-10.199,10.199v86.987h-54.252V40.372H368.34V471.629z M491.602,471.628H388.739V168.747h102.863V471.628z"></path> </g> </g> <g> <g> <path d="M232.995,163.169h-58.218c-5.633,0-10.199,4.566-10.199,10.199v58.218c0,5.633,4.566,10.199,10.199,10.199h58.218 c5.633,0,10.199-4.566,10.199-10.199v-58.218C243.194,167.735,238.628,163.169,232.995,163.169z M222.795,221.387h-37.82v-37.82 h37.82V221.387z"></path> </g> </g> <g> <g> <path d="M337.223,163.169h-58.218c-5.632,0-10.199,4.566-10.199,10.199v58.218c0,5.633,4.567,10.199,10.199,10.199h58.218 c5.632,0,10.199-4.566,10.199-10.199v-58.218C347.423,167.735,342.855,163.169,337.223,163.169z M327.024,221.387h-37.82v-37.82 h37.82V221.387z"></path> </g> </g> <g> <g> <path d="M467.973,183.019h-56.156c-5.632,0-10.199,4.566-10.199,10.199v56.155c0,5.633,4.567,10.199,10.199,10.199h56.156 c5.632,0,10.199-4.566,10.199-10.199v-56.155C478.172,187.585,473.605,183.019,467.973,183.019z M457.774,239.173h-35.757v-35.756 h35.757V239.173z"></path> </g> </g> <g> <g> <path d="M467.973,282.441h-56.156c-5.632,0-10.199,4.566-10.199,10.199v56.156c0,5.633,4.567,10.199,10.199,10.199h56.156 c5.632,0,10.199-4.566,10.199-10.199v-56.156C478.172,287.008,473.605,282.441,467.973,282.441z M457.774,338.597h-35.757V302.84 h35.757V338.597z"></path> </g> </g> <g> <g> <path d="M467.973,381.982h-56.156c-5.632,0-10.199,4.566-10.199,10.199v56.155c0,5.633,4.567,10.199,10.199,10.199h56.156 c5.632,0,10.199-4.566,10.199-10.199v-56.155C478.172,386.548,473.605,381.982,467.973,381.982z M457.774,438.136h-35.757V402.38 h35.757V438.136z"></path> </g> </g> <g> <g> <path d="M99.808,183.019H43.654c-5.633,0-10.199,4.566-10.199,10.199v56.155c0,5.633,4.566,10.199,10.199,10.199h56.155 c5.633,0,10.199-4.566,10.199-10.199v-56.155C110.008,187.585,105.441,183.019,99.808,183.019z M89.609,239.173H53.853v-35.756 h35.756V239.173z"></path> </g> </g> <g> <g> <path d="M99.808,282.441H43.654c-5.633,0-10.199,4.566-10.199,10.199v56.156c0,5.633,4.566,10.199,10.199,10.199h56.155 c5.633,0,10.199-4.566,10.199-10.199v-56.156C110.008,287.008,105.441,282.441,99.808,282.441z M89.609,338.597H53.853V302.84 h35.756V338.597z"></path> </g> </g> <g> <g> <path d="M99.808,381.982H43.654c-5.633,0-10.199,4.566-10.199,10.199v56.155c0,5.633,4.566,10.199,10.199,10.199h56.155 c5.633,0,10.199-4.566,10.199-10.199v-56.155C110.008,386.548,105.441,381.982,99.808,381.982z M89.609,438.136H53.853V402.38 h35.756V438.136z"></path> </g> </g> <g> <g> <path d="M232.995,266.458h-58.218c-5.633,0-10.199,4.566-10.199,10.199v58.218c0,5.633,4.566,10.199,10.199,10.199h58.218 c5.633,0,10.199-4.566,10.199-10.199v-58.218C243.194,271.024,238.628,266.458,232.995,266.458z M222.795,324.676h-37.82v-37.82 h37.82V324.676z"></path> </g> </g> <g> <g> <path d="M337.223,266.458h-58.218c-5.632,0-10.199,4.566-10.199,10.199v58.218c0,5.633,4.567,10.199,10.199,10.199h58.218 c5.632,0,10.199-4.566,10.199-10.199v-58.218C347.423,271.024,342.855,266.458,337.223,266.458z M327.024,324.676h-37.82v-37.82 h37.82V324.676z"></path> </g> </g> <g> <g> <path d="M256,404.49c-5.633,0-10.199,4.566-10.199,10.199v0.938c0,5.633,4.566,10.199,10.199,10.199 c5.632,0,10.199-4.566,10.199-10.199v-0.938C266.199,409.056,261.632,404.49,256,404.49z"></path> </g> </g> <g> <g> <path d="M275.35,65.267c-4.027,0-8.053,1.445-8.053,4.853v25.298h-20.548V70.119c0-3.408-4.027-4.853-8.053-4.853 c-4.028,0-8.054,1.445-8.054,4.853v65.674c0,3.304,4.027,4.956,8.054,4.956c4.027,0,8.053-1.652,8.053-4.956V107.81h20.548v27.982 c0,3.304,4.027,4.956,8.053,4.956c4.027,0,8.054-1.652,8.054-4.956V70.119C283.404,66.712,279.377,65.267,275.35,65.267z"></path> </g> </g> </g></svg>
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
    
                                <form method="POST" action="{{ route('partenaire.login') }}" class="mt-12 space-y-4">
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
