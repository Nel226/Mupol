<!-- start navbar -->
<nav class="navbar-vertical navbar hidden lg:block">
   <div id="myScrollableElement" class="h-screen p-2" data-simplebar>
      <!-- brand logo -->
      <a class="navbar-brand !flex items-center gap-2" href="/">
        <img class="h-16" src="{{  asset('images/logofinal.png') }}" alt="Logo">
        <h3 class="text-primary1 font-bold">{{ config('app.name') }}</h3>
      </a>
      <!-- User Profile -->
      <div class="user-profile txt-sm flex items-center mb-4 p-2 bg-gray-800 rounded-md">
            @if (Auth::guard('adherent')->check())
                <!-- Adherent profile -->
                <img src="{{ asset('storage/' . Auth::guard('adherent')->user()->photo) }}" alt="User Profile" class="h-12 w-12 rounded-full mr-3">
                <span class="font-semibold text-white">{{ Auth::guard('adherent')->user()->nom }}</span>
            @elseif (Auth::guard('partenaire')->check())
                <!-- Centre de santé (partenaire) profile -->
                
                <img src="{{ asset('storage/' . Auth::guard('partenaire')->user()->photo)  }}" alt="Centre de santé Profile" class="h-12 w-12 rounded-full mr-3">
                <span class="font-semibold text-white">{{ Auth::guard('partenaire')->user()->nom }}</span>
            @else
                <!-- Default or guest profile -->
                <img src="{{ asset('storage/default-profile.jpg') }}" alt="Default Profile" class="h-12 w-12 rounded-full mr-3">
                <span class="font-semibold text-white">Utilisateur non connecté</span>
            @endif
      </div>

      <div class="user-profile  mb-4 ">
          <span class=" font-bold ">Menu</span>
          <hr class="h-0.5 mt-2 bg-white">
      </div>

      <nav class="mt-4 font-semibold">
          @if (Auth::guard('adherent')->check())
          <ul class="space-y-2">
              <li>
                <a href="{{ route('adherents.dashboard') }}" 
                      class="@if(Request::is('adherents/dashboard')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                      <i class="fa fa-user mr-3"></i>
                      <span>Mon Profil</span>
                  </a>
              </li>
              
              
              <li>
                  <a href="{{ route('adherents.prestations') }}" 
                      class="@if(Request::is('adherents/prestations*')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                      <i class="fa fa-file mr-3"></i>
                      <span>Demande de remboursement</span>
                  </a>
              </li>
              <li>
                  <a href="{{  route('adherents.ayantsdroits') }}" class="@if(Request::is('adherents/ayantsdroits') || Request::is('adherents/ayantsdroits/*')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                      <i class="fa fa-users mr-3"></i>
                      <span>Mes ayants droits</span>
                  </a>
              </li>

              <li>
                <form method="POST" action="{{ route('adherent.logout') }}" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                    @csrf
                    <button type="submit" class="text-gray-600" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-sign-out-alt mr-3"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
                
              </li>
              
              
              
          </ul>
          @endif
          @if (Auth::guard('partenaire')->check())
          <ul class="space-y-2">
              <li>
                  <a href="{{ route('partenaires.dashboard') }}" 
                      class="@if(Request::is('partenaires/dashboard')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                      <i class="fa fa-home mr-3"></i>
                      <span>Profil</span>
                  </a>
              </li>
              
              <li>
                  <a href="{{ route('partenaires.nouvelle-prestation') }}" 
                  class="@if(Request::is('partenaire/prestations*') || Request::is('partenaire/rechercher-adherent')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                  <i class="fa fa-search mr-3"></i>
                      <span>Recherche</span>
                  </a>
              </li>
              
              <li>
                  <a href="{{ route('partenaire.restrictions') }}" 
                      class="@if(Request::is('partenaires/restrictions')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                      <i class="fa fa-warning mr-3"></i>
                      <span>Restrictions</span>
                  </a>
              </li>
              
              <li>
                  <form method="POST" action="{{ route('partenaire.logout') }}" class="flex items-center p-2 text-red-500 hover:bg-red-700 hover:text-white rounded-md">
                      @csrf
                      <button type="submit" class="w-full text-left">
                          <i class="fas fa-sign-out-alt mr-3"></i>
                          Déconnexion
                      </button>
                  </form>
              </li>
          </ul>
          @endif

      </nav>
   </div>
</nav>
<!--end of navbar-->
