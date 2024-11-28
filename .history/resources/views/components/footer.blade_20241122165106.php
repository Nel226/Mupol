<!-- Footer Area -->
<footer id="footer" class="footer">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- About the Mutuelle -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>À propos de la Mutuelle</h2>
                        <p>La Mutuelle vous accompagne avec des services de santé et des solutions adaptées à vos besoins. Notre mission est de protéger et soutenir nos adhérents.</p>
                        <!-- Social Media Links -->
                        <ul class="social">
                            <li><a href="#"><i class="icofont-facebook"></i></a></li>
                            <li><a href="#"><i class="icofont-google-plus"></i></a></li>
                        </ul>
                        <!-- End Social -->
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer f-link">
                        <h2>Liens rapides</h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="/"><i class="fa fa-caret-right"></i>Accueil</a></li>
                                    <li><a href="{{ route('en-construction') }}"><i class="fa fa-caret-right"></i>À propos</a></li>
                                    <li><a href="{{ route('services') }}"><i class="fa fa-caret-right"></i>Nos Services</a></li>
                                    <li><a href="{{ route('en-construction') }}"><i class="fa fa-caret-right"></i>Actualités</a></li>
                                    <li><a href="{{ route('liste-partenaires') }}"><i class="fa fa-caret-right"></i>Partenaires</a></li>

                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="{{ route('en-construction') }}"><i class="fa fa-caret-right"></i>FAQ</a></li>
                                    <li><a href="{{ route('formulaire-adhesion') }}"><i class="fa fa-caret-right"></i>Adhérer</a></li>
                                    <li><a href="{{ route('contacts') }}"><i class="fa fa-caret-right"></i>Nous contacter</a></li>
                                    {{--  <li><a href="#"><i class="fa fa-caret-right"></i>Témoignages</a></li>  --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Horaires</h2>
                        <ul class="time-sidual">
                            <li class="day">Lundi - Vendredi <span>8h00 - 16h00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    
    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="copyright-content">
                        <p>© Copyright {{ date('Y') }} | Tous droits réservés par <a href="/" target="_blank">Mu-POL</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Copyright -->
</footer>
<!--/ End Footer Area -->
