<div class="relative overflow-hidden w-full h-screen z-10">
    <div class="relative w-full h-full">
      <!-- Slide 1 -->
      {{--  <!-- Slide 4 -->
      <div class="absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out" id="slide4">
        <img src="{{ asset('images/caroussel/caroussel5.jpg') }}" alt="Slide 4" class="w-full h-full object-contain md:object-cover">
      </div>  --}}
      <div class="absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out" id="slide2">
        <img src="{{ asset('images/caroussel/caroussel4.png') }}" alt="Slide 2" class="w-full h-full object-contain md:object-cover">
      </div>
      <!-- Slide 2 -->
      <div class="absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out" id="slide1">
        <img src="{{ asset('images/caroussel/caroussel1.jpg') }}" alt="Slide 1" class="w-full h-full object-contain md:object-cover">
      </div>
     
     
      <div class="absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out" id="slide4">
        <img src="{{ asset('images/caroussel/caroussel3.jpg') }}" alt="Slide 4" class="w-full h-full object-contain md:object-cover">
      </div>
     
    </div>
  
    <div class="absolute right-5 mx-auto md:right-10 top-0 bottom-0 flex flex-col justify-center  text-center p-6 md:p-8 text-white w-full md:w-1/3 z-20 bg-opacity-50 bg-black md:bg-transparent">
      <h2 class="text-2xl md:text-3xl font-bold leading-tight">Bienvenue à la MUPOL</h2>
      <h3 class="text-lg md:text-xl mt-2 leading-snug">Tous solidaires pour votre bien-être</h3>
      
      <div class="mt-4 md:mt-6 mx-auto w-full md:w-50 z-20 flex justify-center">
          <a href="{{ route('formulaire-adhesion') }}">
              <x-primary-button >
                  Adhérer maintenant
              </x-primary-button>
          </a>
      </div>
    </div>
</div>
  
<script>
    const slides = document.querySelectorAll('.absolute img');
    let index = 0;

    function nextSlide() {
        slides.forEach((slide, i) => {
        slide.parentElement.style.opacity = i === index ? 1 : 0;
        });
        index = (index + 1) % slides.length;
    }

    setInterval(nextSlide, 4000);
    nextSlide(); // Initial call
</script>
  