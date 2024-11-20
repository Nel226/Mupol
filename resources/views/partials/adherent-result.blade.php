@if ($adherent)
    <div class="bg-green-100 p-4 rounded-lg">
        <p><strong>Nom :</strong> {{ $adherent->nom }}</p>
        <p><strong>Prénom :</strong> {{ $adherent->prenom }}</p>
        <p><strong>Genre :</strong> {{ $adherent->genre }}</p>
        <p><strong>Téléphone :</strong> {{ $adherent->telephone }}</p>
        <p><strong>Email :</strong> {{ $adherent->email }}</p>
    </div>
@else
    <div class="text-red-500">Aucun adhérent trouvé avec ce code carte.</div>
@endif
