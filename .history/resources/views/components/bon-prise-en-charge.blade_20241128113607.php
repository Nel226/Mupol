

<div class="container-bon">
    <style>
        .container-bon {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ccc;
            padding: 20px;
        }
    
        h1, h2, h3 {
            text-align: center;
            margin: 5px 0;
        }
    
        h1 {
            font-size: 16px;
            color: #800080; /* Violet foncé */
        }
    
        h2 {
            font-size: 14px;
            color: #800080;
        }
    
        h3 {
            font-size: 12px;
        }
    
        .header {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }
    
        .header img {
            position: absolute;
            top: 0;
            left: 0;
            width: 90px;
        }
    
        .header p {
            margin: 5px 0;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
    
        table, th, td {
            border: 1px solid #000;
        }
    
        th, td {
            text-align: left;
            padding: 8px;
        }
    
        .section-title {
            background-color: #800080;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            color: white;
            border: 1px solid #800080; /* Bordures violettes */
        }
    
        .important {
            font-size: 10px;
            text-align: center;
            background-color: #f9f9f9;
            color: #800080; /* Texte violet */
            border-top: 1px solid #800080;
        }
    
        .small-note {
            font-size: 10px;
            margin-bottom: 20px;
        }
    
        .right-align {
            text-align: right;
        }
    
        .center {
            text-align: center;
        }
    
        th {
            background-color: #f2f2f2;
            color: #616161;
            text-align: center;
        }
    
        .input-field {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ccc;
        }
    
        .checkbox-group {
            margin-top: 5px;
        }
    
        .checkbox-group input {
            margin-right: 5px;
        }
    </style>
    <div class="header">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo">
          
            <h2>BON DE PRISE EN CHARGE MEDICALE</h2>
            <p>Mutualité de la Police Nationale "MP/PN"<br>Tel : +226 53 01 87 53 - Email : demo@examplemail.com</p>
        </div>

        <h3>BULLETIN N° : </h3>

        <table>
            <tr>
                <td>Date :</td>
                <td><input type="date" class="input-field"></td>
                <td>Heure :</td>
                <td><input type="time" class="input-field"></td>
            </tr>
        </table>

        <div class="section-title">1. ETABLISSEMENT MEDICAL CONVENTIONNE</div> --}}

        <div class="section-title">{{--2.--}} INFORMATION DU MUTUALISTE</div>
        <table>
            <thead>
                <tr>
                    <th colspan="2">Adhérent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Code ID</td>
                    <td><input type="text" readonly class="input-field" value=" {{ $adherent->code_carte }} "></td>
                </tr>
                <tr>
                    <td>Nom et Prénoms</td>
                    <td><input type="text" readonly class="input-field" value=" {{ $adherent->nom }}  {{ $adherent->prenom }}"></td>
                </tr>
            </tbody>
        </table>
        
        <br> <!-- Pour espacer les tableaux -->
        
        {{-- <table>
            <thead>
                <tr>
                    <th colspan="4">Patient</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1">Nom et Prénoms</td>
                    <td colspan="3"><input type="text" id="nomPrenom" class="input-field" readonly></td>
                </tr>
                <tr>
                    <td colspan="1">Code ID</td>
                    <td colspan="3">
                        <select class="input-field" name="code_id" id="code_id">
                            <option value="">Sélectionner un Code ID</option>
                            @if ($adherent->nombreAyantsDroits > 0)
                                @foreach($adherent->ayantsDroits as $ayantDroit)
                                    <option value="{{ $ayantDroit['nom'] }}" 
                                            data-sexe="{{ $ayantDroit['sexe'] }}" 
                                            data-statut="{{ $ayantDroit['relation'] }}" 
                                            data-date-naissance="{{ $ayantDroit['date_naissance'] }}"
                                            data-nom-prenom="{{ $ayantDroit['prenom'] }} {{ $ayantDroit['nom'] }}">
                                        {{ $ayantDroit['prenom'] }} {{ $ayantDroit['nom'] }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Age :</td>
                    <td><input type="number" class="input-field" id="age"></td>
        
                    <td>Sexe :</td>
                    <td class="checkbox-group">
                        <input type="radio" name="sexe" value="M" id="sexeM"> M
                        <input type="radio" name="sexe" value="F" id="sexeF"> F
                    </td>
                </tr>
                <tr>
                    <td>Statut :</td>
                    <td class="checkbox-group">
                        <input type="radio" name="statut" value="conjoint" id="statutConjoint"> Conjoint (e)
                        <input type="radio" name="statut" value="enfant" id="statutEnfant"> Enfant
                    </td>
                    <td>Tel :</td>
                    <td><input type="number" class="input-field" id="tel"></td>
                </tr>
            </tbody>
        </table>
        
        <script>
            document.getElementById('code_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var sexe = selectedOption.getAttribute('data-sexe');
                var statut = selectedOption.getAttribute('data-statut');
                var nomPrenom = selectedOption.getAttribute('data-nom-prenom');
                var dateNaissance = selectedOption.getAttribute('data-date-naissance');

                document.getElementById('nomPrenom').value = nomPrenom;
        
                document.getElementById('sexeM').checked = (sexe === 'M');
                document.getElementById('sexeF').checked = (sexe === 'F');
        
                if (dateNaissance) {
                    var birthDate = new Date(dateNaissance);
                    var age = new Date().getFullYear() - birthDate.getFullYear();
                    var m = new Date().getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && new Date().getDate() < birthDate.getDate())) {
                        age--;
                    }
                    document.getElementById('age').value = age;
                }
        

                document.getElementById('statutConjoint').checked = (statut === 'conjoint');
                document.getElementById('statutEnfant').checked = (statut === 'enfant');
            });
        </script>
        
        
        <p class="small-note">Signature : 
            <br>
        </p>
        <!-- Section 3 : Actes Médicaux -->
        <div id="section3" class="hidden">
            <div class="section-title">3. ACTES MEDICAUX</div>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Désignation (Actes médicaux)</th>
                        <th>Plafond</th>
                        <th>Coût/Acte</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="actesMedicauxBody">
                    <tr>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><button onclick="deleteRow(this)" class="bg-red-500 text-white px-2 py-1 rounded"><i class=" fa fa-trash"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr><td colspan="5" class="important">IMPORTANT ! Validité du bulletin de prise en charge : 5 jours - Taux = 80%</td></tr>
                    <tr>
                        <td colspan="5" class="text-center border-t border-gray-300">
                            <x-primary-button onclick="addRow('actesMedicauxBody')" class="bg-primary1"><i class="fa  fa-plus-circle"></i></x-primary-button>

                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    
        <!-- Section 4 : Prescription Médicamenteuse -->
        <div id="section4" class="hidden">
            <div class="section-title">4. PRESCRIPTION MEDICAMENTEUSE</div>
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Médicaments</th>
                        <th>Posologie</th>
                        <th>Quantité</th>
                        <th>Prix Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="prescriptionBody">
                    <tr>
                        <td>1</td>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="number" class="input-field"></td>
                        <td><input type="number" class="input-field"></td>
                        <td><button onclick="deleteRow(this)" class="bg-red-500 text-white px-2 py-1 rounded"><i class=" fa fa-trash"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr><td colspan="6" class="important">IMPORTANT ! Validité du bulletin de prise en charge : 5 jours - Taux = 80%</td></tr>
                    <tr>
                        <td colspan="6" class="text-center border-t border-gray-300"> 
                            <x-primary-button onclick="addRow('prescriptionBody')" class="bg-primary1"><i class="fa  fa-plus-circle"></i></x-primary-button>

                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    
        <!-- Section 5 : Examens Complémentaires -->
        <div id="section5" class="hidden">
            <div class="section-title">5. EXAMENS COMPLEMENTAIRES</div>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Désignation (Actes médicaux)</th>
                        <th>Plafond</th>
                        <th>Code/Acte</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="examensBody">
                    <tr>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><input type="text" class="input-field"></td>
                        <td><button onclick="deleteRow(this)" class="bg-red-500 text-white px-2 py-1 rounded"><i class=" fa fa-trash"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr><td colspan="5" class="important">IMPORTANT ! Validité du bulletin de prise en charge : 5 jours - Taux = 80%</td></tr>
                    <tr>
                        <td colspan="5" class="text-center border-t border-gray-300">    
                            <x-primary-button onclick="addRow('examensBody')" class="bg-primary1"><i class="fa  fa-plus-circle"></i></x-primary-button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Boutons pour afficher/masquer les sections -->
        <div class="flex space-x-4 mb-6">
            <button onclick="toggleSection('section3')" class="bg-blue-500 text-white px-4 py-2 rounded">Afficher/Cacher Actes Médicaux</button>
            <button onclick="toggleSection('section4')" class="bg-blue-500 text-white px-4 py-2 rounded">Afficher/Cacher Prescription Médicamenteuse</button>
            <button onclick="toggleSection('section5')" class="bg-blue-500 text-white px-4 py-2 rounded">Afficher/Cacher Examens Complémentaires</button>
        </div> 
        
        
        <script>
            function toggleSection(sectionId) {
                const section = document.getElementById(sectionId);
                section.classList.toggle('hidden');
            }
        
            function addRow(tbodyId) {
                const tbody = document.getElementById(tbodyId);
                const newRow = tbody.querySelector('tr').cloneNode(true);
                tbody.appendChild(newRow);
            }
        
            function deleteRow(button) {
                const row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
        </script>
        

        <p class="small-note">Signature et cachet médecin prescripteur : 
            <br>
        </p> --}}
    </div>

