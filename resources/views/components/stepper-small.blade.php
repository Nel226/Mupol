<div>
    <!-- Stepper -->
    <ul class="flex flex-col justify-center items-center mb-4 md:mb-6 sm:hidden" id="stepper">
        @for ($step = 1; $step <= $totalSteps; $step++)
        <li class="flex justify-center items-center w-full mb-2 sm:mb-4">
            <!-- Stepper Rectangle for Small Screens -->
            <div 
                class="flex flex-col items-center w-full rounded-xl border transition-all duration-200 step" 
                data-step="{{ $step }}"
                style="cursor: pointer;"
            >
                <!-- Step Number and Label on the Same Line -->
                <div class="flex items-center justify-center w-full">
                    <!-- Step Number -->
                    <span class="text-sm sm:text-xl py-2 mx-2 font-semibold step-number">
                        {{ $step }}.
                    </span>
                    <!-- Step Label -->
                    <span class="step-title text-sm font-semibold">
                        {{ $steps[$step - 1] ?? "Étape $step" }}
                    </span>
                </div>
            </div>
        </li>
        @endfor
    </ul>

    <!-- Contenu des étapes -->
    <div id="step-content">
        @for ($step = 1; $step <= $totalSteps; $step++)
        <div class="step-content" data-step="{{ $step }}" style="display: none;">
            <!-- Vous pouvez personnaliser le contenu de chaque étape ici -->
            <h2>Contenu de l'étape {{ $step }}</h2>
        </div>
        @endfor
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const steps = document.querySelectorAll('.step');
        const contents = document.querySelectorAll('.step-content');

        function showStep(step) {
            // Gérer l'affichage des étapes
            contents.forEach(content => {
                content.style.display = content.dataset.step == step ? 'block' : 'none';
            });

            // Mettre à jour le style actif
            steps.forEach(stepElement => {
                if (stepElement.dataset.step == step) {
                    stepElement.classList.add('bg-primary1', 'border-primary1');
                    stepElement.querySelector('.step-number').classList.add('text-white');
                    stepElement.querySelector('.step-title').classList.add('text-white');
                } else {
                    stepElement.classList.remove('bg-primary1', 'border-primary1');
                    stepElement.querySelector('.step-number').classList.remove('text-white');
                    stepElement.querySelector('.step-title').classList.remove('text-white');
                }
            });
        }

        // Écouter les clics sur les étapes
        steps.forEach(step => {
            step.addEventListener('click', function () {
                const stepNumber = this.dataset.step;
                showStep(stepNumber);
            });
        });

        // Initialisation : afficher la première étape
        showStep(1);
    });
</script>
