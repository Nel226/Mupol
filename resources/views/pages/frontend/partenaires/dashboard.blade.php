<x-guest-layout class="main-container">
    <style>
        .main-container {
            display: flex;
            flex-direction: row;
            min-height: 100vh; /* Assurez-vous que la page prend toute la hauteur */
        }
    </style>

    <x-header-guest/>
   
        {{--  <x-preloader/>  --}}
        <x-sidebar-guest/>
        <div class=" content">
            <style>
                .content {
                    padding: 1rem;
                }
            </style>

            <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3">
                <section class="container mx-auto px-6">
                    
                    <!-- Header Start -->
                    <div class="container-fluid header bg-primary p-0 mb-5">
                        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
                            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                                <h1 class="display-4 text-white mb-5">Une bonne santé est la racine de tout bonheur</h1>
                                <div class="row g-4">
                                    <div class="col-sm-4">
                                        <div class="border-start border-light ps-4">
                                            <h2 class="text-white mb-1" data-toggle="counter-up">123</h2>
                                            <p class="text-light mb-0">Expert Doctors</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="border-start border-light ps-4">
                                            <h2 class="text-white mb-1" data-toggle="counter-up">1234</h2>
                                            <p class="text-light mb-0">Medical Stuff</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="border-start border-light ps-4">
                                            <h2 class="text-white mb-1" data-toggle="counter-up">12345</h2>
                                            <p class="text-light mb-0">Total Patients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="owl-carousel header-carousel">
                                    <div class="owl-carousel-item position-relative">
                                        <img class="img-fluid" src="{{ asset('assets/img/carousel-1.jpg') }}" alt="">
                                        <div class="owl-carousel-text">
                                            <h1 class="display-1 text-white mb-0">Cardiology</h1>
                                        </div>
                                    </div>
                                    <div class="owl-carousel-item position-relative">
                                        <img class="img-fluid" src="{{ asset('assets/img/carousel-2.jpg') }}" alt="">
                                        <div class="owl-carousel-text">
                                            <h1 class="display-1 text-white mb-0">Neurology</h1>
                                        </div>
                                    </div>
                                    <div class="owl-carousel-item position-relative">
                                        <img class="img-fluid" src="{{ asset('assets/img/carousel-3.jpg') }}" alt="">
                                        <div class="owl-carousel-text">
                                            <h1 class="display-1 text-white mb-0">Pulmonary</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header End -->

                    <!-- About Start -->
                    <div class="container-xxl py-5">
                        <div class="container">
                            <div class="row g-5">
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="d-flex flex-column">
                                        <img class="img-fluid rounded w-75 align-self-end" src="{{ asset('assets/img/about-1.jpg')}}" alt="">
                                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="{{asset('assets/img/about-2.jpg') }}" alt="" style="margin-top: -25%;">
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                    <p class="d-inline-block border rounded-pill py-1 px-4">About Us</p>
                                    <h1 class="mb-4">Pourquoi nous faire confiance ? Apprenez à nous connaître !</h1>
                                    <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                                    <p class="mb-4">Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus dolor eos.</p>
                                    <p><i class="far fa-check-circle text-primary me-3"></i>Quality health care</p>
                                    <p><i class="far fa-check-circle text-primary me-3"></i>Only Qualified Doctors</p>
                                    <p><i class="far fa-check-circle text-primary me-3"></i>Medical Research Professionals</p>
                                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- About End -->


                    <!-- Testimonial Start -->
                    <div class="container-xxl py-5">
                        <div class="container">
                            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                                <p class="d-inline-block border rounded-pill py-1 px-4">Testimonial</p>
                                <h1>What Say Our Patients!</h1>
                            </div>
                            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                                <div class="testimonial-item text-center">
                                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-1.jpg" style="width: 100px; height: 100px;">
                                    <div class="testimonial-text rounded text-center p-4">
                                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                                        <h5 class="mb-1">Patient Name</h5>
                                        <span class="fst-italic">Profession</span>
                                    </div>
                                </div>
                                <div class="testimonial-item text-center">
                                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-2.jpg" style="width: 100px; height: 100px;">
                                    <div class="testimonial-text rounded text-center p-4">
                                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                                        <h5 class="mb-1">Patient Name</h5>
                                        <span class="fst-italic">Profession</span>
                                    </div>
                                </div>
                                <div class="testimonial-item text-center">
                                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-3.jpg" style="width: 100px; height: 100px;">
                                    <div class="testimonial-text rounded text-center p-4">
                                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                                        <h5 class="mb-1">Patient Name</h5>
                                        <span class="fst-italic">Profession</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial End -->







                </section>
            </div>
                    
            <section class="section">
                <div class="container h-screen">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                

                                

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</x-guest-layout>
