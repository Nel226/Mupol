<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>


    <!-- Slider Area -->
    <section class="slider">
        <div class="hero-slider">
            @php
                $slides = [
                    ['image' => 'images/caroussel/caroussel6.png', 'title' => 'MU-POl, la Mutuelle de la Police Nationale'],
                    ['image' => 'images/caroussel/caroussel5.jpg', 'title' => 'MU-POl, la Mutuelle de la Police Nationale!'],
                ];
            @endphp
    
            @foreach ($slides as $slide)
                <!-- Start Single Slider -->
                <div class="single-slider" style="background-image:url('{{ $slide['image'] }}')">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="text">
                                    <h1>{{ $slide['title'] }}</h1>
                                    <p>Tous solidaires pour notre bien-être! </p>
                                    <p>Je suis policier (ère), j&apos;adhère ! Pour le bien-être des membres de ma famille (conjoint, enfants), je les adhère ! </p>

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
                <div class="row">
                    @php
                        $services = [
                            [
                                'icon' => 'fa fa-ambulance',
                                'title' => 'Assistance d\'Urgence',
                                'subtitle' => 'Lorem Amet',
                                'description' => 'La mutuelle offre une assistance rapide en cas d\'urgence pour ses adhérents, avec un service de soutien 24/7.',
                                'link' => '#',
                                'link_text' => 'EN SAVOIR PLUS'
                            ],
                            [
                                'icon' => 'icofont-prescription',
                                'title' => 'Consultations Médicales',
                                'subtitle' => 'Fusce Porttitor',
                                'description' => 'Nos médecins partenaires sont disponibles pour des consultations médicales générales et spécialisées.',
                            'link' => '#',
                            'link_text' => 'EN SAVOIR PLUS'
                        ],
                        [
                            'icon' => 'icofont-ui-hospital',
                            'title' => 'Soins Hospitaliers',
                                'subtitle' => 'Donec Luctus',
                                'description' => 'La mutuelle couvre une partie des frais hospitaliers pour garantir un accès abordable aux soins.',
                                'link' => '#',
                                'link_text' => 'EN SAVOIR PLUS'
                            ]
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

    <!-- Start Feautes -->
    <section class="Feautes section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nous sommes toujours prêts à vous aider, vous et votre famille</h2>
                        <img src="img/section-img.png" alt="#">
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
    </section>
    
    <!--/ End Feautes -->
    
    <!-- Start Fun-facts -->
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
    <!--/ End Fun-facts -->
    
    <!-- Start Why choose -->
    <section class="why-choose section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nous Offrons Divers Services Pour Améliorer Votre Santé</h2>
                        <img src="img/section-img.png" alt="#" style="height: 150px;"> <!-- Hauteur fixe ajoutée -->
                        <p>La Mutuelle de la Police Nationale propose des services variés pour votre bien-être et celui de votre famille.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- Start Choose Left -->
                    <div class="choose-left">
                        <h3>Qui sommes-nous ?</h3>
                        <p>Nous sommes une mutuelle engagée à offrir des services de santé accessibles et de qualité à nos membres. Notre mission est de vous accompagner au quotidien.</p>
                        <p>Forte de son expérience, la Mutuelle de la Police Nationale met à votre disposition des prestations adaptées à vos besoins spécifiques.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list">
                                    <li><i class="fa fa-caret-right"></i>Accès aux soins de qualité.</li>
                                    <li><i class="fa fa-caret-right"></i>Assistance en cas d&apos;urgence.</li>
                                    <li><i class="fa fa-caret-right"></i>Réductions sur les médicaments.</li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list">
                                    <li><i class="fa fa-caret-right"></i>Des médecins partenaires.</li>
                                    <li><i class="fa fa-caret-right"></i>Suivi personnalisé.</li>
                                    <li><i class="fa fa-caret-right"></i>Des services adaptés à vos besoins.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Choose Left -->
                </div>
                <div class="col-lg-6 col-12">
                    <!-- Start Choose Right -->
                    <div class="choose-right">
                        <img src="{{ asset('images/accueil/accueil7.jpg') }}" alt="" style="height: 350px; width: 100%;"> <!-- Hauteur et largeur fixées -->
                    </div>
                    <!-- End Choose Right -->
                </div>
            </div>
        </div>
    </section>
    <!--/ End Why choose -->

    
    <!-- Start Call to action -->
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
    <!--/ End Call to action -->
    

    <!-- Start service -->
    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>We Offer Different Services To Improve Your Health</h2>
                        <img src="img/section-img.png" alt="#">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-prescription"></i>
                        <h4><a href="service-details.html">General Treatment</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-tooth"></i>
                        <h4><a href="service-details.html">Teeth Whitening</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-heart-alt"></i>
                        <h4><a href="service-details.html">Heart Surgery</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-listening"></i>
                        <h4><a href="service-details.html">Ear Treatment</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-eye-alt"></i>
                        <h4><a href="service-details.html">Vision Problems</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-blood"></i>
                        <h4><a href="service-details.html">Blood Transfusion</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!--/ End service -->
    
    <!-- Start Blog Area -->
    <section class="blog section" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Keep up with Our Most Recent Medical News.</h2>
                        <img src="img/section-img.png" alt="#">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Blog -->
                    <div class="single-news">
                        <div class="news-head">
                            <img src="{{ asset('images/accueil/accueil5.jpg') }}" alt="#">
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
    
    
    <x-footer/>

</x-guest-layout>

