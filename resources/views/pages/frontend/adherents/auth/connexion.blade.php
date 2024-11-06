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
                                    <div class="rounded-full ">
                                        <x-application-logo class=" mx-auto" />

                                    </div>
                                </div>
                            </div>
                            <div class="max-w-md w-full mx-auto border p-8 rounded-tr-lg rounded-br-lg bg-gray-200">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" class="inline-block" viewBox="0 0 53 53">
                                        <path fill="#e7eced" d="m18.613 41.552-7.907 4.313a7.106 7.106 0 0 0-1.269.903A26.377 26.377 0 0 0 26.5 53c6.454 0 12.367-2.31 16.964-6.144a7.015 7.015 0 0 0-1.394-.934l-8.467-4.233a3.229 3.229 0 0 1-1.785-2.888v-3.322c.238-.271.51-.619.801-1.03a19.482 19.482 0 0 0 2.632-5.304c1.086-.335 1.886-1.338 1.886-2.53v-3.546c0-.78-.347-1.477-.886-1.965v-5.126s1.053-7.977-9.75-7.977-9.75 7.977-9.75 7.977v5.126a2.644 2.644 0 0 0-.886 1.965v3.546c0 .934.491 1.756 1.226 2.231.886 3.857 3.206 6.633 3.206 6.633v3.24a3.232 3.232 0 0 1-1.684 2.833z" data-original="#e7eced" />
                                        <path fill="#556080" d="M26.953.004C12.32-.246.254 11.414.004 26.047-.138 34.344 3.56 41.801 9.448 46.76a7.041 7.041 0 0 1 1.257-.894l7.907-4.313a3.23 3.23 0 0 0 1.683-2.835v-3.24s-2.321-2.776-3.206-6.633a2.66 2.66 0 0 1-1.226-2.231v-3.546c0-.78.347-1.477.886-1.965v-5.126S15.696 8 26.499 8s9.75 7.977 9.75 7.977v5.126c.54.488.886 1.185.886 1.965v3.546c0 1.192-.8 2.195-1.886 2.53a19.482 19.482 0 0 1-2.632 5.304c-.291.411-.563.759-.801 1.03V38.8c0 1.223.691 2.342 1.785 2.888l8.467 4.233a7.05 7.05 0 0 1 1.39.932c5.71-4.762 9.399-11.882 9.536-19.9C53.246 12.32 41.587.254 26.953.004z" data-original="#556080" />
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
    
                                <form method="POST" action="{{ route('adherent.login') }}" class="mt-12 space-y-4">
                                    @csrf
                                    <div class="relative flex items-center">
                                        <input name="email" type="text" required
                                            class="w-full text-sm text-gray-800 bg-white border-2 border-transparent focus:border-[#1E2772] px-4 py-3 rounded-md outline-none"
                                            placeholder="Entrez votre email" />
                                        <i class="fa fa-envelope absolute right-4 text-gray-400"></i>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input name="password" type="password" required
                                            class="w-full text-sm text-gray-800 bg-white border-2 border-transparent focus:border-[#1E2772] px-4 py-3 rounded-md outline-none"
                                            placeholder="Entrez votre mot de passe" />
                                        <i class="fa fa-lock absolute right-4 text-gray-400 cursor-pointer"></i>
                                    </div>
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
