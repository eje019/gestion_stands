@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un produit</h1>
    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" step="0.01" name="prix" id="prix" class="form-control" value="{{ old('prix') }}" required>
            @error('prix')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">URL de l'image</label>
            <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url') }}">
            @error('image_url')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
