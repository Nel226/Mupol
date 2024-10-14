<x-guest-layout>
    <x-header-guest/>
    <x-section-guest>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <h1>Résumé de la Demande d'Adhésion</h1>
        
        <ul>
            <li><strong>Matricule:</strong> {{ $demandeAdhesion->matricule }}</li>
            <li><strong>NIP:</strong> {{ $demandeAdhesion->nip }}</li>
            <li><strong>CNIB:</strong> {{ $demandeAdhesion->cnib }}</li>
            <li><strong>Date de délivrance:</strong> {{ $demandeAdhesion->delivree }}</li>
            <li><strong>Date d'expiration:</strong> {{ $demandeAdhesion->expire }}</li>
            <li><strong>Adresse:</strong> {{ $demandeAdhesion->adresse }}</li>
            <li><strong>Téléphone:</strong> {{ $demandeAdhesion->telephone }}</li>
            <li><strong>Nom:</strong> {{ $demandeAdhesion->nom }}</li>
            <li><strong>Prénom:</strong> {{ $demandeAdhesion->prenom }}</li>
            <li><strong>Genre:</strong> {{ $demandeAdhesion->genre }}</li>
            <li><strong>Département:</strong> {{ $demandeAdhesion->departement }}</li>
            <li><strong>Ville:</strong> {{ $demandeAdhesion->ville }}</li>
            <li><strong>Pays:</strong> {{ $demandeAdhesion->pays }}</li>
            <li><strong>Nom du père:</strong> {{ $demandeAdhesion->nom_pere }}</li>
            <li><strong>Nom de la mère:</strong> {{ $demandeAdhesion->nom_mere }}</li>
            <li><strong>Situation matrimoniale:</strong> {{ $demandeAdhesion->situation_matrimoniale }}</li>
            <li><strong>Nom et prénom de la personne à prévenir:</strong> {{ $demandeAdhesion->nom_prenom_personne_besoin }}</li>
            <li><strong>Lieu de résidence:</strong> {{ $demandeAdhesion->lieu_residence }}</li>
            <li><strong>Téléphone de la personne à prévenir:</strong> {{ $demandeAdhesion->telephone_personne_prevenir }}</li>
            <li><strong>Nombre d&apos;ayants droits:</strong> {{ $demandeAdhesion->nombreAyantsDroits }}</li>
            <li><strong>Statut:</strong> {{ $demandeAdhesion->statut }}</li>
            <li><strong>Grade:</strong> {{ $demandeAdhesion->grade }}</li>
            <li><strong>Date de départ à la retraite:</strong> {{ $demandeAdhesion->departARetraite }}</li>
            <li><strong>Numéro CARFO:</strong> {{ $demandeAdhesion->numeroCARFO }}</li>
            <li><strong>Date d&apos;intégration:</strong> {{ $demandeAdhesion->dateIntegration }}</li>
            <li><strong>Date de départ à la retraite:</strong> {{ $demandeAdhesion->dateDepartARetraite }}</li>
            <li><strong>Direction:</strong> {{ $demandeAdhesion->direction }}</li>
            <li><strong>Service:</strong> {{ $demandeAdhesion->service }}</li>
        </ul>
    </x-section-guest>
</x-guest-layout>

