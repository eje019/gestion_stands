@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-violet-700 dark:text-violet-300 text-center">Mon panier</h1>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 rounded bg-violet-100 dark:bg-violet-900 text-violet-800 dark:text-violet-200 font-semibold text-center shadow">{{ session('success') }}</div>
    @endif
    @if(empty($panier))
        <p class="text-center text-gray-500 dark:text-gray-400">Votre panier est vide.</p>
    @else
        <form action="{{ route('panier.valider') }}" method="POST" class="space-y-4">
            @csrf
            <div class="overflow-x-auto rounded-lg shadow mb-4">
                <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg">
                    <thead>
                        <tr class="bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-200">
                            <th class="py-3 px-2">Produit</th>
                            <th class="py-3 px-2">Quantité</th>
                            <th class="py-3 px-2">Prix unitaire</th>
                            <th class="py-3 px-2">Total</th>
                            <th class="py-3 px-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($produits as $produit)
                            @php $sousTotal = $produit->prix * $panier[$produit->id]; $total += $sousTotal; @endphp
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <td class="py-2 px-2 font-semibold">{{ $produit->nom }}</td>
                                <td class="py-2 px-2">
                                    <form action="{{ route('panier.modifier', $produit->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        <input type="number" name="quantite" value="{{ $panier[$produit->id] }}" min="1" class="w-16 rounded-lg border-0 px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500" />
                                        <button type="submit" class="px-3 py-1 bg-violet-200 dark:bg-violet-800 text-violet-800 dark:text-violet-100 rounded hover:bg-violet-300 dark:hover:bg-violet-700 transition">Modifier</button>
                                    </form>
                                </td>
                                <td class="py-2 px-2">{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                                <td class="py-2 px-2 font-bold">{{ number_format($sousTotal, 2, ',', ' ') }} €</td>
                                <td class="py-2 px-2">
                                    <form action="{{ route('panier.supprimer', $produit->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-100 rounded hover:bg-red-300 dark:hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <span class="text-xl font-bold text-violet-700 dark:text-violet-300">Total : {{ number_format($total, 2, ',', ' ') }} €</span>
                <button type="submit" class="mt-4 sm:mt-0 px-6 py-2 bg-violet-600 hover:bg-violet-800 text-white font-bold rounded-lg shadow transition">Valider la commande</button>
            </div>
        </form>
    @endif
</div>
@endsection
