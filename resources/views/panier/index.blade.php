@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mon panier</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(empty($panier))
        <p>Votre panier est vide.</p>
    @else
        <form action="{{ route('panier.valider') }}" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($produits as $produit)
                        @php $sousTotal = $produit->prix * $panier[$produit->id]; $total += $sousTotal; @endphp
                        <tr>
                            <td>{{ $produit->nom }}</td>
                            <td>
                                <form action="{{ route('panier.modifier', $produit->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="number" name="quantite" value="{{ $panier[$produit->id] }}" min="1" style="width:50px;">
                                    <button type="submit">Modifier</button>
                                </form>
                            </td>
                            <td>{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                            <td>{{ number_format($sousTotal, 2, ',', ' ') }} €</td>
                            <td>
                                <form action="{{ route('panier.supprimer', $produit->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p><strong>Total :</strong> {{ number_format($total, 2, ',', ' ') }} €</p>
            <button type="submit">Valider la commande</button>
        </form>
    @endif
</div>
@endsection
