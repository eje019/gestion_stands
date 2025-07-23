@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('stands.show', $produit->stand->id) }}" class="btn btn-secondary mb-3">&larr; Retour au stand</a>
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $produit->nom }}</h2>
            <p class="card-text">{{ $produit->description }}</p>
            <p class="card-text"><strong>Prix :</strong> {{ number_format($produit->prix, 2, ',', ' ') }} €</p>
            @if($produit->image_url)
                <img src="{{ $produit->image_url }}" alt="Image produit" class="img-fluid" style="max-height:200px;">
            @endif
            <hr>
            <p class="card-text"><strong>Stand :</strong> <a href="{{ route('stands.show', $produit->stand->id) }}">{{ $produit->stand->nom_stand }}</a></p>
            <p class="card-text"><strong>Entreprise :</strong> {{ $produit->stand->user->nom_entreprise ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection
