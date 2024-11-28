<!-- Stepper -->
<div class="flex flex-stepper justify-between items-center mb-4 md:mb-6">
    @for ($step = 1; $step <= $totalSteps; $step++)
    <div class="flex justify-center flex-col items-center flex-1 {{ $step == 1 || $step == $totalSteps ? 'w-[calc(100%/4)]' : '' }}">

            <div class="relative flex items-center w-full">
                <!-- Ligne connectante invisible pour la première étape -->
                @if ($step == 1)
                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                @endif

                <!-- Connecting Line -->
                @if ($step > 1 && $step <= $totalSteps)
                    <div class="flex-1 h-1 {{ $currentStep >= $step ? 'bg-[#4000FF]' : 'bg-gray-300' }}"
                         style="height: 3px; margin-left: -0.5rem;"></div>
                @endif
                <!-- Step Circle -->
                <div class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 flex shadow-lg items-center justify-center {{ $currentStep >= $step ? 'bg-[#4000FF]' : 'bg-gray-300' }} rounded-full text-white z-10">
                    @if ($currentStep > $step)
                        <i class="fa fa-check"></i>
                    @else
                        {{ $step }}
                    @endif
                </div>
                <!-- Connecting Line -->
                @if ($step < $totalSteps)
                    <div class="flex-1 h-1 {{ $currentStep > $step ? 'bg-[#4000FF]' : 'bg-gray-300' }}"
                        style="height: 3px; margin-left: -0.5rem;"></div>
                @endif

                <!-- Ligne connectante invisible pour la dernière étape -->
                @if ($step == $totalSteps)
                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                @endif
            </div>
            <!-- Step Label -->
            <div class="text-xs mt-2 text-center w-full h-12 overflow-hidden">
                <p class="step-label whitespace-normal break-words">
                    @if ($step == 1) Références de l&apos;adhérent
                    @elseif ($step == 2) Etat civil
                    @elseif ($step == 3) Informations personnelles
                    @elseif ($step == 4) Informations professionnelles
                    @elseif ($step == 5) Récapitulatif
                    @endif
                </p>
            </div>
        </div>
    @endfor
</div>