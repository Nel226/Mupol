<!-- Header Area -->
<header class="header  border-b" >
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo flex gap-2 items-center">
                          <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo de la Mutuelle" class="h-16 w-auto"></a>
                          <h3 class=" font-bold md:text-base lg:text-base">Mutuelle de la Police Nationale (MU-POL)</h3>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li class="active"><a href="/">Accueil</a></li>
                                    <li><a href="#">Nos Services <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="">Santé</a></li>
                                            <li><a href="">Prévoyance</a></li>
                                            <li><a href="">Assistance</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">À propos <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="">Présentation</a></li>
                                            <li><a href="">Notre Équipe</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-3 flex items-center justify-between col-12">
                        <div class="get-quote">
                            <a class="btn btn-primary" href="{{ route('formulaire-adhesion') }}">
                                Adhérer maintenant
                            </a>
                        </div>
                        <div class="">
                            <a class=" text-[#4B45DC] " href="{{ route('adherant.login') }}">
                                Connexion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->
