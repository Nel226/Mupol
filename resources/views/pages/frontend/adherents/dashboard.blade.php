<x-guest-layout >

    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                
                setTimeout(() => {
                    notification.classList.add('hidden'); // Cache le message après 5 secondes
                }, 5000);
            });
        </script>
    @endif
    @if (Auth::guard('adherent')->user()->is_adherent === 0)
        <div class=" h-screen">

            <section class="contact-us section">
                <div class="container">
                    <div class="inner">
                        <div class="row d-flex justify-content-center"> 
                            
                            <div class="col-lg-6  col-md-8 col-12 mx-auto">
                                <div class="contact-us-form  bg-green-100 border border-green-400 text-green-700">
                                    <h2 class=" !text-xl">Votre demande d&apos;adhésion a été bien reçue !</h2>
                                    <p class=" text-justify">Elle est en cours de traitement. Veuillez contacter le <strong>{{ config('contact.phone_mupol') }}</strong>  si vous ne recevez pas de réponse dans les <strong>72 heures (jours ouvrables)</strong> qui suivent votre demande. </p>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </section>
        
        </div>
    @else
    
        <div id="app-layout" class="layout-guest overflow-x-hidden flex">
           @include("components.navbar-guest-connected")
           <!-- app layout content -->
           <div 
           id="app-layout-content" 
           class="min-h-screen w-full lg:pl-[15.625rem] transition-all duration-300 ease-out">
        
               @include("components.top-navbar-guest-connected")

              <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                 <!-- title -->
                 <h1 class="text-xl text-white">{{ $pageTitle }}</h1>
                 
              </div>
              <div class="-mt-12 mx-6 mb-6 ">
               <div class="px-4  text-center ">
                   <div class=" z-30 mx-auto  -mt-20 sm:-mt-24 lg:-mt-32 h-24 w-24 sm:h-32 sm:w-32 lg:h-40 lg:w-40 rounded-full bg-white/20 p-1 backdrop-blur">
                       <img src="{{  asset('storage/' . $adherent->photo)}}" alt="profile" class="rounded-full w-full h-full object-cover" />
                   </div>
                   <h3 class="mb-1.5 text-xl sm:text-2xl font-semibold text-black dark:text-white">
                       {{ $adherent->nom }} {{ $adherent->prenom }}
                   </h3>
                   <p class="text-sm font-medium">Catégorie {{ $adherent->categorie }}</p>
               </div>
                  <div class="container ">
                     
                      <div class="inner">
                          <!-- Widgets en colonnes -->
                          <div class="row ">
                              <!-- Première colonne -->
                              <div class="col-lg-6 col-12 mb-4 px-0 px-lg-3 no-gutter-mobile">

                                  <div class="main-sidebar">
                                      <div class="single-widget category">
                                          <h3 class="title">Références</h3>
                                          <ul class="categor-list">
                                              <li><strong>Matricule :</strong> {{ $adherent->matricule }}</li>
                                              <li><strong>NIP :</strong> {{ $adherent->nip }}</li>
                                              <li><strong>CNIB :</strong> {{ $adherent->cnib }}</li>
                                              <li><strong>Adresse :</strong> {{ $adherent->adresse }}</li>
                                              <li><strong>Téléphone :</strong> {{ $adherent->telephone }}</li>
                                              <li><strong>Email :</strong> {{ $adherent->email }}</li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                  
                              <!-- Deuxième colonne -->
                              <div class="col-lg-6 col-12 mb-4 px-0 px-lg-3 no-gutter-mobile">

                                  <div class="main-sidebar">
                                      <div class="single-widget side-tags">
                                          <h3 class="title">Etat civil</h3>
                                          <ul class="categor-list">
                                              <li><strong>Nom :</strong> {{ $adherent->nom }}</li>
                                              <li><strong>Prénom (s) :</strong> {{ $adherent->prenom }}</li>
                                              <li><strong>Genre :</strong> {{ $adherent->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</li>
                                              <li><strong>Lieu de naissance :</strong> {{ $adherent->lieu_naissance }}</li>
                                              <li><strong>Nom et prénom (s) du père :</strong> {{ $adherent->nom_pere }}</li>
                                              <li><strong>Nom et prénom (s) de la mère :</strong> {{ $adherent->nom_mere }}</li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row ">
                              <!-- Première colonne -->
                              <div class="col-lg-6 col-12 mb-4 px-0 px-lg-3 no-gutter-mobile">
                                  <div class="main-sidebar">
                                      <div class="single-widget category">
                                          <h3 class="title">Informations personnelles</h3>
                                          <ul class="categor-list">
                                              <li><strong>Situation matrimoniale :</strong> {{ $adherent->situation_matrimoniale }}</li>
                                              <li><strong>Personne à prévenir en cas de besoin :</strong> 
                                                  <ol class=" list-disc list">
                                                      <li>Nom et prénom(s) : {{ $adherent->nom_prenom_personne_besoin }} </li>
                                                      <li>Lieu de résidence : {{ $adherent->lieu_residence }} </li>
                                                      <li>Téléphone : {{ $adherent->telephone_personne_prevenir}} </li>
          
                                                  </ol>
                                              </li>
                                              
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                  
                              <!-- Deuxième colonne -->
                              <div class="col-lg-6 col-12 mb-4 px-0 px-lg-3 no-gutter-mobile">

                                  <div class="main-sidebar">
                                      <div class="single-widget side-tags">
                                          <h3 class="title">Informations profesionnelles</h3>
                                          <ul class="categor-list">
                                              @if ($adherent->statut === 'personnel_retraite')
                                  
                                              <li><strong>Statut :</strong> Personnel retraité</li>
                                              <li><strong>Grade :</strong> {{ $adherent->grade }}</li>
                                              <li><strong>Date de départ à la retraite :</strong> {{ $adherent->departARetraite }}</li>
                                              <li><strong>N° CARFO :</strong> {{ $adherent->numeroCARFO }}</li>
                                              @else
                                              <li><strong>Statut :</strong> Personnel en activité</li>
                                              <li><strong>Grade :</strong> {{ $adherent->grade }}</li>
                                              <li><strong>Date d&apos;intégration :</strong> {{ $adherent->dateIntegration }}</li>
                                              <li><strong>Date de départ à la retraite :</strong> {{ $adherent->dateDepartARetraite }}</li>
                                              <li><strong>N° CARFO :</strong> {{ $adherent->numeroCARFO }}</li>
                                              <li><strong>Direction :</strong> {{ $adherent->direction }}</li>
                                              <li><strong>Service :</strong> {{ $adherent->service }}</li>
          
                                              @endif
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                
              </div>
              
              @include("components.footer-guest-connected")
           </div>
        </div>

        @include("components.scripts")

    @endif
</x-guest-layout>
