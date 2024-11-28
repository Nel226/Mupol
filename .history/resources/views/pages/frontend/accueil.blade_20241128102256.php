<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>
    <hr class=" w-full h-0.5 bg-white">

    <!-- Slider Area -->
    <section class="slider">
        <div class="hero-slider">
            @php
                $slides = [
                    
                    ['image' => 'images/caroussel/caroussel8.jpg', 'title' => 'MU-POl, la Mutuelle de la Police Nationale', 'text_color' => 'white'],
                    ['image' => 'images/caroussel/caroussel10.JPG', 'title' => 'MU-POl, la Mutuelle de la Police Nationale', 'text_color' => 'white'],

                ];
            @endphp
        
    
            @foreach ($slides as $slide)
            <!-- Start Single Slider -->
            <div class="container">
                <div class="single-slider !p-4" style="background-image:url('{{ $slide['image'] }}')">
                    <div class="row">
                        <div class="col-lg-7 !p-2">
                            <div class="text text-stroke-200 bg-gray-700 bg-opacity-50 ">
                                <h1 class="{{ $slide['text_color'] === 'white' ? 'text-white' : 'text-black' }}">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="{{ $slide['text_color'] === 'white' ? 'text-white' : 'text-black' }}" >Tous solidaires pour notre bien-être!</p>
                                <p class="{{ $slide['text_color'] === 'white' ? 'text-white' : 'text-black' }}">Je suis policier (ère), j&apos;adhère ! Pour le bien-être des membres de ma famille (conjoint, enfants), je les adhère ! </p>
        
                                <div class="button">
                                    <a class="btn" href="{{ route('formulaire-adhesion') }}">
                                        Adhérer maintenant
                                    </a>
                                    <a href="#" class="btn primary">A propos de nous</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slider -->
        @endforeach
        
        </div>
    </section>
    
    <!--/ End Slider Area -->
    
    <!-- Start Schedule Area -->
    <section class="schedule">
        <div class="container">
            <div class="schedule-inner">
                <div class="row  !-m-1"> 
                    @php
                        $services = [
                           
                       
                        [
                            'icon' => 'icofont-hospital',
                            'title' => 'Hôpitaux Partenaires',
                            'subtitle' => 'Soins spécialisés',
                            'description' => 'Nos hôpitaux partenaires offrent une gamme de soins spécialisés pour nos adhérents, avec une couverture partielle des frais hospitaliers.',
                            'link' => '#',
                            'link_text' => 'EN SAVOIR PLUS'
                        ],
                        [
                            'icon' => 'icofont-hospital',
                            'title' => 'Cliniques Partenaires',
                            'subtitle' => 'Soins de proximité',
                            'description' => 'Nos cliniques partenaires offrent des soins de proximité, y compris des consultations et des traitements de courte durée, accessibles à nos adhérents.',
                            'link' => '#',
                            'link_text' => 'EN SAVOIR PLUS'
                        ],
                        [
                            'icon' => 'icofont-medical-sign',
                            'title' => 'Pharmacies Partenaires',
                            'subtitle' => 'Médicaments à prix réduits',
                            'description' => 'Nous avons des partenariats avec des pharmacies locales qui offrent des médicaments à prix réduits pour nos adhérents.',
                            'link' => '#',
                            'link_text' => 'EN SAVOIR PLUS'
                        ],
                        ];
                        
                    @endphp
                
                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- single-schedule -->
                            <div class="single-schedule">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="{{ $service['icon'] }}"></i>
                                    </div>
                                    <div class="single-content">
                                        <span>{{ $service['subtitle'] }}</span>
                                        <h4>{{ $service['title'] }}</h4>
                                        <p>{{ $service['description'] }}</p>
                                        <a href="{{ $service['link'] }}">{{ $service['link_text'] }}<i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </section>
    <!--/End Start schedule Area -->

    {{--  <!-- Start Feautes -->
    <section class="Feautes section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nous sommes toujours prêts à vous aider, vous et votre famille</h2>
                        <img  class="mx-auto" src="{{ asset('images/section-img.png') }}" alt="#">
                        <p>La Mutuelle de la Police Nationale vous soutient à chaque étape de votre vie.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- Start Single features -->
                    <div class="single-features">
                        <div class="signle-icon">
                            <i class="icofont icofont-ambulance-cross"></i>
                        </div>
                        <h3>Aide d'urgence</h3>
                        <p>Intervention rapide pour nos adhérents en cas d'urgence médicale.</p>
                    </div>
                    <!-- End Single features -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- Start Single features -->
                    <div class="single-features">
                        <div class="signle-icon">
                            <i class="icofont icofont-medical-sign-alt"></i>
                        </div>
                        <h3>Pharmacie enrichie</h3>
                        <p>Accès à des médicaments essentiels avec des réductions pour nos membres.</p>
                    </div>
                    <!-- End Single features -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- Start Single features -->
                    <div class="single-features last">
                        <div class="signle-icon">
                            <i class="icofont icofont-stethoscope"></i>
                        </div>
                        <h3>Traitement médical</h3>
                        <p>Des soins adaptés à vos besoins, en toute confiance avec nos médecins partenaires.</p>
                    </div>
                    <!-- End Single features -->
                </div>
            </div>
        </div>
    </section>  --}}
    
    <!--/ End Feautes -->
    
    {{--  <!-- Start Fun-facts -->
    <div id="fun-facts" class="fun-facts section overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont icofont-home"></i>
                        <div class="content">
                            <span class="counter">3468</span>
                            <p>Hospital Rooms</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont icofont-user-alt-3"></i>
                        <div class="content">
                            <span class="counter">557</span>
                            <p>Specialist Doctors</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont-simple-smile"></i>
                        <div class="content">
                            <span class="counter">4379</span>
                            <p>Happy Patients</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont icofont-table"></i>
                        <div class="content">
                            <span class="counter">32</span>
                            <p>Years of Experience</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Fun-facts -->  --}}
    
    <!-- Start Why choose -->
    <section class="why-choose section" id="apropos">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title who">
                        <h2>Le mot du Président du Conseil d&apos;administration</h2>
                        <img  class="mx-auto" src="{{ asset('images/section-img.png') }}" alt="#">
                        <p>La Mutuelle de la Police Nationale propose des services variés pour votre bien-être et celui de votre famille.</p>
                    </div>
                </div>
            </div>
            
        
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="choose-content">
                        <div class="img-polaroid">

                            <img src="{{ asset('images/accueil/accueil8.jpg') }}" class="" alt="Photo PCA">
                            <figcaption class="photo-caption">Président du Conseil d&apos;Administration</figcaption>
                        </div>

                        <h3 class=" font-bold text-lg my-2">Qui sommes-nous ?</h3>
                        <p>
                            La Mutuelle de la Police Nationale (MU-POL) qui a été portée sur les fonts baptismaux lors d’une Assemblée Générale constitutive le 19 novembre 2022 et lancée officiellement le 28 juillet 2023, constitue la plus vaste entreprise sociale portée par la Police Nationale. Je voudrais, à l’occasion du lancement de la présente page Facebook de la MU-POL, remercier les plus hautes autorités, le Ministre en charge de la sécurité, les Directeurs généraux de la Police Nationale, tout le Commandement de la Police Nationale et l’UNAPOL dont les efforts conjugués nous ont permis d’avoir ce bel instrument de solidarité permettant d’offrir une assurance santé et diverses prestations sociales aux policiers, au personnel civil de la Police Nationale et aux policiers à la retraite.
                        </p>
                        <p>
                            Ma reconnaissance s’adresse particulièrement aux 4000 policiers et leurs familles qui ont adhéré à la Mutuelle, lesquels sont devenus nos premiers mutualistes et je les félicite pour leur esprit de solidarité. Je remercie aussi notre équipe, notamment les membres du Conseil d’Administration et son Secrétaire général, le Directeur général de la MU-POL et ses collaborateurs pour leur dévouement et leurs sacrifices pour assurer la bonne gouvernance de la Mutuelle et l’administration diligente des prestations. Nous sommes au service des policiers pour faciliter l’accès à des soins médicaux de qualité à coût social. La Mutuelle prend en charge vos soins médicaux à hauteur de 80% et développera d’autres types de prestations sociales qui participent au bien-être du policier. Le remboursement des frais médicaux a effectivement commencé le 1er juin 2024. La Mutuelle appartient à chaque policier et je vous invite à prendre possession de votre instrument en y adhérant massivement. Cette page Facebook a été créée afin de faire mieux connaitre la MU-POL et d’offrir aux mutualistes un espace de communication et de dialogue interactifs. Il ne nous reste plus qu’à souhaiter plein succès à la MU-POL avec la participation et la contribution de tout un chacun.
                            Tous solidaires pour notre bien-être !
                        </p>
                        <!-- Signature -->
                        <div class="signature">
                            <p><strong>Le Président du Conseil d’Administration</strong></p>
                            <p><strong>Thierry Dofizouho TUINA</strong></p>
                            <p>Inspecteur Général de Police</p>
                            <p>Chevalier de l’Ordre de l’Etalon</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!--/ End Why choose -->

    
    {{--  <!-- Start Call to action -->
    <section class="call-action overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="content">
                        <h2>Do you need Emergency Medical Care? Call @ 1234 56789</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque porttitor dictum turpis nec gravida.</p>
                        <div class="button">
                            <a href="#" class="btn">Contact Now</a>
                            <a href="#" class="btn second">Learn More<i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Call to action -->  --}}
    

    <!-- Start service -->
    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nous offrons différentes services de rembousements </h2>
                        <img  class="mx-auto" src="{{ asset('images/section-img.png') }}" alt="#">
                        <p>La Mutuelle vous accompagne dans le remboursement de différentes prestations.</p>
                    </div>
                </div>
            </div>
            <div class="row">
              

                @foreach ($types as $type)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Service -->
                        <div class="single-service">
                            @switch($type)
                                @case('consultation')
                                    <i class="icofont icofont-stethoscope"></i>
                                    <h4><a href="service-details.html">Consultation</a></h4>
                                    <p>{{ $descriptions['consultation'] }}</p>
                                    @break
                                @case('hospitalisation')
                                    <i class="icofont icofont-hospital"></i>
                                    <h4><a href="service-details.html">Hospitalisation</a></h4>
                                    <p>{{ $descriptions['hospitalisation'] }}</p>
                                    @break
                                @case('radio')
                                    <i class="icofont icofont-heart-alt"></i>
                                    <h4><a href="service-details.html">Radiologie</a></h4>
                                    <p>{{ $descriptions['radio'] }}</p>
                                    @break
                                @case('maternite')
                                    <i class="icofont icofont-baby"></i>
                                    <h4><a href="service-details.html">Maternité</a></h4>
                                    <p>{{ $descriptions['maternite'] }}</p>
                                    @break
                                @case('allocation')
                                    <i class="icofont icofont-money"></i>
                                    <h4><a href="service-details.html">Allocations</a></h4>
                                    <p>{{ $descriptions['allocation'] }}</p>
                                    @break
                                @case('analyse_biomedicale')
                                    <i class="icofont icofont-test-tube"></i>
                                    <h4><a href="service-details.html"> Analyses Biomedicales</a></h4>
                                    <p>{{ $descriptions['analyse_biomedicale'] }}</p>
                                    @break
                                @case('pharmacie')
                                    <i class="icofont icofont-medical-sign"></i>
                                    <h4><a href="service-details.html">Pharmacie</a></h4>
                                    <p>{{ $descriptions['pharmacie'] }}</p>
                                    @break
                                @case('optique')
                                    <i class="icofont icofont-eye-alt"></i>
                                    <h4><a href="service-details.html">Optique</a></h4>
                                    <p>{{ $descriptions['optique'] }}</p>
                                    @break
                                @case('dentaire_auditif')
                                    <i class="icofont icofont-tooth"></i>
                                    <h4><a href="service-details.html">Soins dentaires et auditifs</a></h4>
                                    <p>{{ $descriptions['dentaire_auditif'] }}</p>
                                    @break
                                
                            @endswitch
                        </div>
                        <!-- End Single Service -->
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!--/ End service -->
    
    <!-- Start Blog Area -->
    <section class="blog section" id="actualites">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>La vie de la mutuelle.</h2>
                        <img  class="mx-auto" src="{{ asset('images/section-img.png') }}" alt="#">
                        <p>Evènements récents organisés par la mutuelle.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Blog -->
                    <div class="single-news">
                        <div class="news-head">
                            <img src="{{ asset('images/actualites/actualite3.jpg') }}" alt="#">
                        </div>
                        <div class="news-body">
                            <div class="news-content">
                                <div class="date">22 Aug, 2020</div>
                                <h2><a href="blog-single.html">We have annnocuced our new product.</a></h2>
                                <p class="text">Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod tempor incididunt sed do incididunt sed.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Blog -->
                    <div class="single-news">
                        <div class="news-head">
                            <img src="{{ asset('images/accueil/accueil3.jpg') }}" alt="#">
                        </div>
                        <div class="news-body">
                            <div class="news-content">
                                <div class="date">15 Jul, 2020</div>
                                <h2><a href="blog-single.html">Top five way for solving teeth problems.</a></h2>
                                <p class="text">Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod tempor incididunt sed do incididunt sed.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Blog -->
                    <div class="single-news">
                        <div class="news-head">
                            <img src="{{ asset('images/accueil/accueil4.jpg') }}" alt="#">
                        </div>
                        <div class="news-body">
                            <div class="news-content">
                                <div class="date">05 Jan, 2020</div>
                                <h2><a href="blog-single.html">We provide highly business soliutions.</a></h2>
                                <p class="text">Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod tempor incididunt sed do incididunt sed.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Area -->
    
    
      

</x-guest-layout>

