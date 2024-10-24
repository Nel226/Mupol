<h2>Ajouter votre signature</h2>
        <x-signature-pad wire:model.defer="signature">

        </x-signature-pad>
        <!-- Champ pour dessiner la signature -->
        <div class="signature-container">
            <label for="signatureCanvas">Dessinez votre signature :</label><br>
            <canvas id="signatureCanvas"></canvas>
            <button id="clearSignature" style="margin-top: 10px;">Effacer la signature</button>
        </div>
    
        <!-- Ou téléverser une image de signature -->
        <div class="upload-container">
            <label for="signatureUpload">Ou téléchargez une image de votre signature :</label><br>
            <input type="file" id="signatureUpload" accept="image/*"><br>
            <img id="uploadedSignaturePreview" style="max-width: 100%; height: auto; margin-top: 10px;">
        </div>
    
        <button id="submitSignature" style="margin-top: 20px;">Soumettre la signature</button>
    
        <script>
            // Initialiser le canvas de signature avec Signature Pad
            var canvas = document.getElementById('signatureCanvas');
            var signaturePad = new SignaturePad(canvas);
    
            // Fonction pour effacer la signature
            document.getElementById('clearSignature').addEventListener('click', function () {
                signaturePad.clear();
            });
    
            // Gestion de l'upload de fichier
            document.getElementById('signatureUpload').addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        document.getElementById('uploadedSignaturePreview').src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    
            // Soumettre la signature
            document.getElementById('submitSignature').addEventListener('click', function () {
                if (!signaturePad.isEmpty()) {
                    // Si l'utilisateur a dessiné une signature
                    var signatureDataUrl = signaturePad.toDataURL();
                    console.log("Signature dessinée :", signatureDataUrl);
                    // Vous pouvez envoyer cette image via AJAX à votre serveur pour la sauvegarder
                } else {
                    // Si l'utilisateur a téléchargé une image de signature
                    var uploadedSignature = document.getElementById('uploadedSignaturePreview').src;
                    if (uploadedSignature) {
                        console.log("Image téléchargée :", uploadedSignature);
                        // Vous pouvez envoyer cette image via AJAX à votre serveur pour la sauvegarder
                    } else {
                        alert("Veuillez dessiner ou télécharger une signature.");
                    }
                }
            });
        </script>