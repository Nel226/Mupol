<x-app-layout>
    <x-sidebar/>

    <x-content-page>

        <div class="container mt-5">
            <h1 class="mb-4">Détails du Centre de Santé</h1>
            <div class="card">
                <div class="card-header">
                    <h4>{{ $centre->nom }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Type :</strong> {{ $centre->type }}</p>
                    <p><strong>Adresse :</strong> {{ $centre->adresse }}</p>
                    <p><strong>Téléphone :</strong> {{ $centre->telephone }}</p>
                    <p><strong>Email :</strong> {{ $centre->email }}</p>
                    <p><strong>Région :</strong> {{ $centre->region }}</p>
                    <p><strong>Province :</strong> {{ $centre->province }}</p>
                    <p><strong>Date d'affiliation :</strong> {{ $centre->date_affiliation }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('centres-sante.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    <a href="{{ route('centres-sante.edit', $centre) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('centres-sante.destroy', $centre) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce centre ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </x-content-page>

</x-app-layout>
