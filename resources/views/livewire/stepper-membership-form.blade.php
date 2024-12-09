<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <!-- Stepper -->
                <!-- Stepper pour les petits écrans (<= 450px) -->
                <ul class="flex flex-col justify-center items-center mb-4 md:mb-6 sm:hidden">
                    @for ($step = 1; $step <= $totalSteps; $step++)
                    <li class="flex justify-center items-center w-full mb-2 sm:mb-4">
                        <!-- Stepper Rectangle for Small Screens -->
                        <div class="flex flex-col items-center w-full rounded-xl border {{ $currentStep >= $step ? 'border-primary1' : 'border-gray-300' }} {{ $currentStep == $step ? 'bg-primary1' : 'bg-white' }} hover:bg-primary1 hover:border-primary1 transition-all duration-200">
                            <!-- Step Number and Label on the Same Line -->
                            <div class="flex items-center justify-center w-full" wire:click="goToStep({{ $step }})">
                                <!-- Step Number -->
                                <span class=" text-sm sm:text-xl py-2 mx-2 text-black {{ $currentStep == $step ? 'text-white' : 'text-gray-700' }} font-semibold">
                                    {{ $step }}.
                                </span>
                                <!-- Step Label -->
                                <span class="step-title text-sm {{ $currentStep == $step ? 'text-white' : 'text-gray-600' }} font-semibold">
                                    @if ($step == 1) Références de l&apos;adhérent
                                    @elseif ($step == 2) Etat civil
                                    @elseif ($step == 3) Informations personnelles
                                    @elseif ($step == 4) Informations professionnelles
                                    @elseif ($step == 5) Récapitulatif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </li>
                    @endfor
                </ul>

                <!-- Stepper pour les grands écrans (> 450px) -->
                <div class="flex-stepper justify-between items-center mb-4 md:mb-6 hidden sm:flex">
                    @for ($step = 1; $step <= $totalSteps; $step++)
                        <div class="flex justify-center flex-col items-center flex-1 {{ $step == 1 || $step == $totalSteps ? 'w-[calc(100%/4)]' : '' }}">
                            <div class="relative flex items-center w-full" wire:click="goToStep({{ $step }})">
                                <!-- Ligne connectante invisible pour la première étape -->
                                @if ($step == 1)
                                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif

                                <!-- Connecting Line -->
                                @if ($step > 1 && $step <= $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep >= $step ? 'bg-primary1' : 'bg-gray-300' }}"
                                        style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif
                                <!-- Step Circle -->
                                <div class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 flex shadow-lg items-center justify-center {{ $currentStep >= $step ? 'bg-primary1' : 'bg-gray-300' }} rounded-full text-white z-10 transition-all duration-200 hover:bg-primary1 hover:scale-110 cursor-pointer">
                                    @if ($currentStep > $step)
                                        <i class="fa fa-check"></i>
                                    @else
                                        {{ $step }}
                                    @endif
                                </div>
                                <!-- Connecting Line -->
                                @if ($step < $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep > $step ? 'bg-primary1' : 'bg-gray-300' }}"
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
</div>
