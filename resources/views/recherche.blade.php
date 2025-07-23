@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Résultats de la recherche</h1>
    <form action="{{ route('recherche') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Rechercher un stand ou un produit..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if($stands->isEmpty() && $produits->isEmpty())
        <p>Aucun résultat trouvé pour "{{ request('q') }}".</p>
    @else
        @if(!$stands->isEmpty())
            <h2>Stands</h2>
            <div class="row">
                @foreach($stands as $stand)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $stand->nom_stand }}</h5>
                                <p class="card-text">{{ $stand->description }}</p>
                                <p class="card-text"><small class="text-muted">Par : {{ $stand->user->nom_entreprise ?? 'N/A' }}</small></p>
                                <a href="{{ route('stands.show', $stand->id) }}" class="btn btn-primary">Voir les produits</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(!$produits->isEmpty())
            <h2>Produits</h2>
            <div class="row">
                @foreach($produits as $produit)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $produit->nom }}</h5>
                                <p class="card-text">{{ $produit->description }}</p>
                                <p class="card-text"><strong>Prix :</strong> {{ number_format($produit->prix, 2, ',', ' ') }} €</p>
                                <a href="{{ route('produits.show_public', $produit->id) }}" class="btn btn-secondary">Voir le produit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection
