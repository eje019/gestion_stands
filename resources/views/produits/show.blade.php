@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <a href="{{ route('stands.show', $produit->stand->id) }}" class="inline-block mb-6 px-4 py-2 bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 font-semibold rounded-lg hover:bg-violet-200 dark:hover:bg-violet-800 transition">&larr; Retour au stand</a>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-8 border border-violet-100 dark:border-violet-900 flex flex-col items-center">
        @if($produit->image_url)
            <img src="{{ $produit->image_url }}" alt="Image produit" class="object-cover mb-6 rounded shadow max-h-56">
        @endif
        <h2 class="text-2xl font-bold text-violet-800 dark:text-violet-300 mb-2">{{ $produit->nom }}</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-4 text-center">{{ $produit->description }}</p>
        <p class="text-2xl font-bold text-violet-600 dark:text-violet-400 mb-4">{{ number_format($produit->prix, 2, ',', ' ') }} €</p>
        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-2 mb-4">
            @csrf
            <input type="number" name="quantite" value="1" min="1" class="w-20 rounded-lg border-0 px-2 py-1 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500" />
            <button type="submit" class="px-6 py-2 bg-violet-600 hover:bg-violet-800 text-white font-bold rounded-lg shadow transition">Ajouter au panier</button>
        </form>
        <div class="w-full flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
            <span><strong>Stand :</strong> <a href="{{ route('stands.show', $produit->stand->id) }}" class="text-violet-600 dark:text-violet-400 hover:underline">{{ $produit->stand->nom_stand }}</a></span>
            <span><strong>Entreprise :</strong> {{ $produit->stand->user->nom_entreprise ?? 'N/A' }}</span>
        </div>
        <a href="{{ route('panier.index') }}" class="mt-6 inline-block px-6 py-2 bg-violet-200 dark:bg-violet-800 text-violet-800 dark:text-violet-100 font-bold rounded-lg shadow hover:bg-violet-300 dark:hover:bg-violet-700 transition">🛒 Voir le panier</a>
    </div>
</div>
@endsection
