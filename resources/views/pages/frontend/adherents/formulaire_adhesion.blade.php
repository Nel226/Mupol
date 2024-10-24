<x-guest-layout>
        <x-preloader/>

        <x-header-guest/>

	
		<!-- Breadcrumbs -->
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
		<!-- End Breadcrumbs -->
				
		<section class=" section">
			<div class="container">
				<div class="">
					<div class="row "> 
						
						<div class="col-lg-12">
                            <!-- Form -->
                            <livewire:wizard-membership />
                            <!--/ End Form -->
							
						</div>
					</div>
				</div>
				
			</div>
		</section>
		
        <x-footer/>
 
</x-guest-layout>
