@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des stands</h1>
    <form action="{{ route('recherche') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Rechercher un stand ou un produit..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
    @if($stands->isEmpty())
        <p>Aucun stand disponible pour le moment.</p>
    @else
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
</div>
@endsection
