@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes produits</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
    @if($produits->isEmpty())
        <p>Aucun produit enregistré.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->description }}</td>
                        <td>{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                        <td>
                            @if($produit->image_url)
                                <img src="{{ $produit->image_url }}" alt="Image" width="60" height="60">
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline-block; margin-left:5px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
