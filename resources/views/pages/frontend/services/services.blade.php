<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>


    
    <!-- Single News -->
		<section class="news-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="row">
							<div class="col-12">
                                <div class="single-main " contenteditable="true">
                                    <!-- News Head -->
                                    <div class="news-head">
                                        <img src="{{ asset('images/services/service1.jpg') }}" alt="Mutuelle Services Image">
                                    </div>
                                    <!-- News Title -->
                                    <h1 class="news-title !text-[#652E92]">
                                        Adhérer à la MU-POL : Bénéficiez d&apos;une Large Gamme de Prestations
                                    </h1>
                                    <!-- News Text -->

                                    <div class="news-text">
                                        <p>En tant que membre de la MU-POL, vous avez accès à une gamme variée de prestations qui couvrent les principaux besoins en santé et bien-être. Découvrez ci-dessous les différents services remboursés :</p>
                                    
                                        <!-- Consultation -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-stethoscope mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Consultation
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('La MU-POL propose un remboursement des frais de consultation médicale, permettant aux adhérents de se faire soigner par divers professionnels de santé, allant des généralistes aux spécialistes. Que vous ayez besoin d’un suivi médical régulier ou de soins pour une condition spécifique, vous pouvez consulter un médecin en toute tranquillité. En plus des consultations générales, la MU-POL couvre également les consultations spécialisées en cardiologie, dermatologie, pédiatrie, et bien d’autres, garantissant ainsi un accès étendu aux soins.')}}                                    </p>
                                    
                                        <!-- Hospitalization -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-hospital mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Hospitalisation
                                        </h3>
                                        <p class=" text-justify">
                                            {{__(' En cas d’hospitalisation, que ce soit pour une intervention chirurgicale, des soins intensifs ou un suivi post-opératoire, la MU-POL prend en charge une partie des frais, en fonction de la durée de votre séjour et de la nature des soins. Ce soutien financier couvre les frais de chambre, de soins infirmiers, et les traitements nécessaires. Que l’hospitalisation soit courte (moins de deux jours) ou prolongée (plus de deux semaines), la MU-POL accompagne les adhérents pour réduire les coûts liés aux soins hospitaliers.') }}
                                        </p>
                                    
                                        <!-- Radiology -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-heart-alt mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Radiologie
                                        </h3>
                                        <p>
                                            {{__('La radiologie est essentielle pour le diagnostic de nombreuses affections. La MU-POL couvre une gamme complète d\'examens d\'imagerie médicale, y compris les radiographies, les échographies, les IRM et les scanners. Ces examens sont pris en charge pour détecter des problèmes de santé spécifiques, permettant un diagnostic et un suivi rapide des pathologies. Que ce soit pour des examens de routine ou des tests plus approfondis, la couverture radiologique est conçue pour vous offrir une tranquillité d\'esprit.') }}
                                        </p>
                                    
                                        <!-- Maternity -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-baby mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Maternité
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('La MU-POL offre un soutien accru aux futures mamans, prenant en charge les frais de suivi prénatal, des échographies de contrôle, et des frais liés à l’accouchement. Les adhérentes bénéficient d’un accompagnement complet pendant toute la période de grossesse, assurant la sécurité de la mère et de l’enfant. La couverture inclut également les frais en cas de complications médicales, garantissant un accès à des soins de qualité pour le bien-être de la mère et du bébé.') }}
                                        </p>
                                    
                                        <!-- Pharmacy -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-money mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Pharmacie
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('Les dépenses en médicaments peuvent rapidement s\'accumuler, notamment en cas de traitement prolongé. La MU-POL prend en charge une partie des frais pharmaceutiques pour des médicaments prescrits, garantissant ainsi un accès facilité aux traitements nécessaires pour les adhérents et leurs ayants droit. Ce soutien s’applique aussi bien pour les traitements temporaires que pour les traitements de longue durée, allégeant le coût des soins au quotidien.') }}
                                        </p>
                                        
                                        <!-- Biomedical Analysis -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-laboratory mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Analyse Biomédicale
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('La MU-POL prend en charge les frais liés aux analyses biomédicales, essentielles pour le diagnostic et le suivi médical de nombreuses pathologies. Ces analyses comprennent les tests sanguins, les examens urinaires, les cultures microbiologiques, ainsi que d\'autres examens spécialisés comme les bilans de santé réguliers, les dosages hormonaux ou les tests génétiques. Ces analyses sont cruciales pour identifier de manière précoce les maladies et affections, permettant une prise en charge rapide et adaptée.') }}
                                        </p>

                                        <!-- Optical Services -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-eye-alt mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Optique
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('La santé visuelle est primordiale, et la MU-POL s’engage à rembourser une partie des frais liés aux soins optiques. Que ce soit pour des examens de la vue, des lunettes de correction, ou des lentilles, les adhérents peuvent bénéficier d’un soutien financier pour leurs dépenses en optique. Ce remboursement permet de maintenir une bonne vision, essentielle pour la qualité de vie au quotidien.') }}
                                        </p>
                                    
                                        <!-- Dental & Auditory Services -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-tooth mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Soins Dentaires & Auditifs
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('La MU-POL prend en charge les soins dentaires et auditifs, des contrôles de routine aux soins plus spécifiques, tels que les prothèses dentaires et auditives. Ces services incluent des consultations de suivi, des soins de prévention, et des traitements en cas de problèmes dentaires ou auditifs. Ainsi, les adhérents peuvent maintenir une bonne hygiène bucco-dentaire et auditive, indispensable pour la santé générale.') }}
                                        </p>
                                    
                                        <!-- Allocation -->
                                        <h3 class="font-bold text-lg mt-4 mb-1 flex items-center">
                                            <i class="icofont icofont-money mr-2 p-2 bg-[#4000FF] text-white font-bold rounded-md"></i>
                                            Allocation
                                        </h3>
                                        <p class=" text-justify">
                                            {{__('En cas de situation particulière (invalidité, décès d\'un adhérent ou d\'un ayant droit), la MU-POL offre des allocations spécifiques pour aider financièrement les familles dans ces moments difficiles. Cette allocation peut aussi inclure un secours médical pour des traitements exceptionnels ou non couverts. Les adhérents peuvent compter sur cette assistance pour alléger les coûts imprévus liés à des conditions particulières.') }}
                                        </p>

                                        <blockquote class=" mt-4 !bg-[#4000FF]">
                                            <p>« Adhérer à la MU-POL, c&apos;est assurer sa santé et celle de ses proches avec des prestations diversifiées et adaptées à tous les besoins. »</p>
                                        </blockquote>
                                    
                                        {{--  <div class="image-gallery mt-4">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="single-image">
                                                        <img src="{{ asset('images/accueil/accueil6.jpg') }}" alt="Service Image 1">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="single-image">
                                                        <img src="{{ asset('images/accueil/accueil4.jpg') }}" alt="Service Image 2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  --}}
                                    </div>
                                    
                                </div>
                            </div>
                            
							
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="main-sidebar">
							<!-- Single Widget -->
							<div class="single-widget search">
								<div class="form">
									<input type="text" id="findField" placeholder="Rechercher...">
									<button class="button bg-[#4000FF]" href="#" onclick="search();"><i class="fa fa-search"></i></button>
								</div>
                                
                                {{--  <button onclick="removeHightlight();">removeHightlight</button>  --}}  
                                <script>
                                    function findNext(str) {

                                        if (str == "") {
                                            alert("Entrez un mot !");
                                            return;
                                        }
                                        return window.find(str);
                                    }
                                    
                                    function search() {
                                        console.clear();    
                                        removeHightlight();
                                        var sel = window.getSelection();
                                        sel.removeAllRanges();
                                        var str = document.getElementById("findField").value;
                                        document.getElementById("findField").value = "";
                                        console.log("Début de la recherche du mot : ", str);
                                    
                                        while (findNext(str)) {
                                    
                                            var range = sel.getRangeAt(0);        
                                            var hightlightSpan = document.createElement("span");
                                            hightlightSpan.className = "hightlightClass";
                                            hightlightSpan.appendChild(range.extractContents());
                                            range.insertNode(hightlightSpan);
                                        }
                                        console.log("Fin de la recherche");
                                        sel.removeAllRanges();
                                        document.getElementById("findField").value = str;
                                    }
                                    
                                    function removeHightlight() {
                                    
                                        var hightlightSpanTab = document.getElementsByClassName("hightlightClass");
                                        
                                        while(hightlightSpanTab.length) {
                                            var parent = hightlightSpanTab[0].parentNode;
                                            while( hightlightSpanTab[0].firstChild ) {
                                                parent.insertBefore(  hightlightSpanTab[0].firstChild, hightlightSpanTab[0] );
                                            }
                                             parent.removeChild( hightlightSpanTab[0] );
                                        }    
                                    }
                                    
                                </script>
                               
							</div>
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<!-- Catégories des services -->
                            <div class="single-widget category">
                                <h3 class="title">Catégories de services</h3>
                                <ul class="category-list">
                                    <li><a href="#">Consultation</a></li>
                                    <li><a href="#">Hospitalisation</a></li>
                                    <li><a href="#">Radio</a></li>
                                    <li><a href="#">Maternité</a></li>
                                    <li><a href="#">Pharmacie</a></li>
                                    <li><a href="#">Optique</a></li>
                                    <li><a href="#">Dentaire & Auditif</a></li>
                                    
                                </ul>
                            </div>
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<div class="single-widget recent-post">
								<h3 class="title">Actualités récentes</h3>
								<!-- Single Post -->
								<div class="single-post">
									<div class="image">
                                        <img src="{{ asset('images/accueil/accueil6.jpg') }}" alt="Service Image 1">
									</div>
									<div class="content">
										<h5><a href="#">We have annnocuced our new product.</a></h5>
										<ul class="comment">
											<li><i class="fa fa-calendar" aria-hidden="true"></i>Jan 11, 2020</li>
											<li><i class="fa fa-commenting-o" aria-hidden="true"></i>35</li>
										</ul>
									</div>
								</div>
								<!-- End Single Post -->
								<!-- Single Post -->
								<div class="single-post">
									<div class="image">
                                        <img src="{{ asset('images/accueil/accueil6.jpg') }}" alt="Service Image 1">
									</div>
									<div class="content">
										<h5><a href="#">Top five way for solving teeth problems.</a></h5>
										<ul class="comment">
											<li><i class="fa fa-calendar" aria-hidden="true"></i>Mar 05, 2019</li>
											<li><i class="fa fa-commenting-o" aria-hidden="true"></i>59</li>
										</ul>
									</div>
								</div>
								<!-- End Single Post -->
								<!-- Single Post -->
								<div class="single-post">
									<div class="image">
                                        <img src="{{ asset('images/accueil/accueil4.jpg') }}" alt="Service Image 1">
									</div>
									<div class="content">
										<h5><a href="#">We provide highly business soliutions.</a></h5>
										<ul class="comment">
											<li><i class="fa fa-calendar" aria-hidden="true"></i>June 09, 2019</li>
											<li><i class="fa fa-commenting-o" aria-hidden="true"></i>44</li>
										</ul>
									</div>
								</div>
								<!-- End Single Post -->
							</div>
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<div class="single-widget side-tags">
                                <h3 class="title">Tags</h3>
                                <ul class="tag">
                                    <li><a href="#">santé</a></li>
                                    <li><a href="#">consultation</a></li>
                                    <li><a href="#">hospitalisation</a></li>
                                    <li><a href="#">analyse biomédicale</a></li>
                                    <li><a href="#">pharmacie</a></li>
                                    <li><a href="#">optique</a></li>
                                </ul>
                            </div>
							<!--/ End Single Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
	<!--/ End Single News -->
    <x-footer/>

</x-guest-layout>
