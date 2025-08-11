<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="fixed z-20 hidden w-64 h-screen bg-blue-800 border-none rounded-none lg:block">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg md:p-6">
            @role('agentsaisie|controleur')
            <div class="mx-auto md:w-3/4">
                <h2 class="mb-4 text-sm font-bold text-gray-900 md:text-lg lg:text-xl dark:text-white">Entrez le mail</h2>

                <form method="POST" action="{{ route('partenaires.envoyer.mail') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-1 md:gap-5">
                        <div class="flex items-center justify-end space-x-2">
                            <label for="checkbox" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Envoyer à tous les partenaires</label>

                            <input type="checkbox"  name="selectAll" id="selectAll" value="true" class="w-4 h-4 form-checkbox" />
                        </div>
                        <!-- Type de partenaire -->
                        <div id="typeContainer">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de partenaire</label>
                            <select name="type" id="type" class="block w-full p-2 mb-4 !bg-gray-100 border border-gray-300 rounded-lg">
                                <option value="">-- Sélectionner un type --</option>
                                <option value="pharmacie">Pharmacie</option>
                                <option value="clinique">Clinique</option>
                                <option value="laboratoire">Laboratoire</option>
                                <!-- Ajoute d'autres types selon tes données -->
                            </select>
                        </div>
                        <p id="typeCount" class="hidden text-sm font-semibold text-blue-600"></p>


                        <script>
                            $(document).ready(function () {
                                $('.select2').select2({
                                    placeholder: "Sélectionner un partenaire",
                                    allowClear: true,
                                    width: '100%'
                                });

                                function toggleFields() {
                                    if ($('#selectAll').is(':checked')) {
                                        $('select[name="email"]').closest('div').hide();
                                        $('#typeContainer').show();
                                    } else {
                                        $('select[name="email"]').closest('div').show();
                                        $('#typeContainer').hide();
                                        $('#typeCount').hide(); // Cache si non applicable
                                    }
                                }

                                $('#selectAll').on('change', toggleFields);
                                toggleFields();

                                // ➕ Quand un type est sélectionné
                                $('#type').on('change', function () {
                                    const type = $(this).val();
                                    if (type) {
                                        fetch(`/admin/partenaires/count-by-type/${type}`)
                                            .then(res => res.json())
                                            .then(data => {
                                                $('#typeCount')
                                                    .text(`${data.count} partenaire(s) de type "${type}"`)
                                                    .removeClass('hidden');
                                            })
                                            .catch(err => {
                                                console.error('Erreur:', err);
                                                $('#typeCount').text('Erreur de chargement').removeClass('hidden');
                                            });
                                    } else {
                                        $('#typeCount').addClass('hidden').text('');
                                    }
                                });
                            });
                        </script>




                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <select  name="email" class="block w-full p-2 mb-4 !bg-gray-100 border border-gray-300 rounded-lg select2">
                                <option value=""></option> <!-- nécessaire pour le placeholder -->

                                @foreach($partenaires as $partenaire)
                                    <option value="{{ $partenaire->id }}">{{ $partenaire->nom }} : {{ $partenaire->email  }}</option>
                                @endforeach
                            </select>
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <script>
                                $(document).ready(function () {
                                    $('.select2').select2({
                                        placeholder: "Sélectionner un partenaire",
                                        allowClear: true,
                                        width: '100%'
                                    });

                                    $('#selectAll').on('change', function () {
                                        if ($(this).is(':checked')) {
                                            $('select[name="email"]').closest('div').hide();
                                        } else {
                                            $('select[name="email"]').closest('div').show();
                                        }
                                    }).trigger('change'); // pour appliquer l'état dès le chargement
                                });
                            </script>


                        </div>


                        <!-- Objet -->
                        <div >
                            <label for="objet" class="block mb-2 text-sm font-medium text-gray-900">Objet :</label>
                            <input id="objet" name="objet" type="objet" class="block w-full p-2 border border-gray-300 rounded-lg " >
                            @error('objet')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        </div>
                        {{-- message --}}
                        <div>
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                            <textarea
                                name="message"
                                id="message"
                                rows="5"
                                class="block w-full overflow-hidden text-sm text-gray-900 border border-gray-300 rounded-lg resize-none bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Entrez un message"
                                required></textarea>

                            <script>
                                const textarea = document.getElementById('message');
                                textarea.addEventListener('input', autoResize);

                                function autoResize() {
                                    this.style.height = 'auto';
                                    this.style.height = (this.scrollHeight) + 'px';
                                }
                            </script>

                            @error('message')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="mt-5 btn ">
                            Envoyer
                        </button>

                    </div>
                </form>
            </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>



