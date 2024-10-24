<div>
    <h2>Signature Pad</h2>
    <textarea wire:model="signatureText" rows="4" placeholder="Entrez votre signature ici..." style="width: 100%;"></textarea>
    <button wire:click="saveSignature">Sauvegarder la signature</button>

    <div>
        <h3>Signature saisie :</h3>
        <p>{{ $signatureText }}</p>
    </div>
</div>
