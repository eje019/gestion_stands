@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('stands.index') }}" class="btn btn-secondary mb-3">&larr; Retour à la liste des stands</a>
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $stand->nom_stand }}</h2>
            <p class="card-text">{{ $stand->description }}</p>
            <p class="card-text"><strong>Entreprise :</strong> {{ $stand->user->nom_entreprise ?? 'N/A' }}</p>
        </div>
    </div>
    <h3>Produits proposés</h3>
    @if($stand->produits->isEmpty())
        <p>Aucun produit pour ce stand.</p>
    @else
        <div class="row">
            @foreach($stand->produits as $produit)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <a href="{{ route('produits.show_public', $produit->id) }}" style="text-decoration: none; color: inherit;">
                                <h5 class="card-title">{{ $produit->nom }}</h5>
                                <p class="card-text">{{ $produit->description }}</p>
                                <p class="card-text"><strong>Prix :</strong> {{ number_format($produit->prix, 2, ',', ' ') }} €</p>
                                @if($produit->image_url)
                                    <img src="{{ $produit->image_url }}" alt="Image produit" class="img-fluid" style="max-height:100px;">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
