<x-guest-layout>
    <x-header-guest />

    <div class="min-h-screen max-h-fit">
        <div class="relative bg-slate-100 " style="background-size:100% 100%; background-repeat: no-repeat; height: 100vh;">
            <!-- Container for the purple and white sections -->
            <div class="relative w-[80%] lg:w-[80%] mx-auto h-full">

                <div class="bg-blue-800 px-8 justify-center rounded-t-lg shadow-md bg-opacity-70 h-[40%] w-full flex items-center">
                    <!-- Optional content for the purple section -->
                </div>

                <div class="overlay absolute top-[35%] left-1/2 transform -translate-x-1/2 mt-[-80px] lg:mt-[-100px] w-[70%] md:w-[70%] lg:w-[70%] bg-white p-6 rounded-lg shadow-lg z-10">
                    <div class="justify-center mx-auto flex">
                        <img src="{{ asset('images/logofinal.png') }}" alt="Logo" class="w-16">
                    </div>
                    <livewire:wizard-membership />
                </div>


            </div>
        </div>
    </div>

    <style>
        /* Ensure the background image covers the full viewport */
        .bg-cover {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Cover the entire viewport height */
        }

        /* The overlay section should overlap cleanly and stay centered */
        .overlay {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Subtle shadow */
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .overlay {
                width: 90%; /* Adjust width for tablets */
                margin-top: -80px;
            }
        }

        @media (max-width: 768px) {
            .overlay {
                width: 90%; /* Adjust width for mobile screens */
                margin-top: -60px;
            }
        }

        @media (max-width: 480px) {
            .overlay {
                width: 95%;
                margin-top: -50px;
                padding: 16px; /* Reduce padding for small screens */
            }

            h4 {
                font-size: 1rem; /* Reduce font size on small screens */
            }
        }
    </style>
</x-guest-layout>
