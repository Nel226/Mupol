<table>
    <thead>
        <tr>
            <th>Code adhérent</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Sexe</th>
            <th>Bénéficiaire</th>
            <th>ID Prestation</th>
            <th>Contact Prestation</th>
            <th>Acte</th>
            <th>Type</th>
            <th>Sous-Type</th>
            <th>Date</th>
            <th>Centre</th>
            <th>Montant</th>
            <th>Validité</th>
            <th>État paiement</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestations as $prestation)
            <tr>
                <td>{{ $prestation->adherentCode }}</td>
                <td>{{ $prestation->adherentNom }}</td>
                <td>{{ $prestation->adherentPrenom }}</td>
                <td>{{ $prestation->adherentSexe }}</td>
                <td>{{ $prestation->beneficiaire }}</td>
                <td>{{ $prestation->idPrestation }}</td>
                <td>{{ $prestation->contactPrestation }}</td>
                <td>{{ $prestation->acte }}</td>
                <td>{{ $prestation->type }}</td>
                <td>{{ $prestation->sous_type }}</td>
                <td>{{ $prestation->date}}</td>
                <td>{{ $prestation->partenaire->nom ?? '—' }}</td>
                <td>{{ number_format($prestation->montant, 2, ',', ' ') }}</td>
                <td>{{ ucfirst($prestation->validite) }}</td>
                <td>{{ $prestation->etat_paiement ? 'Payé' : 'Non payé' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
