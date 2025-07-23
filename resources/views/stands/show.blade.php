@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <a href="{{ route('stands.index') }}" class="inline-block mb-6 px-4 py-2 bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 font-semibold rounded-lg hover:bg-violet-200 dark:hover:bg-violet-800 transition">&larr; Retour à la liste des stands</a>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8 border border-violet-100 dark:border-violet-900">
        <h2 class="text-2xl font-bold text-violet-800 dark:text-violet-300 mb-2">{{ $stand->nom_stand }}</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-2">{{ $stand->description }}</p>
        <p class="text-sm text-violet-500 dark:text-violet-400 mb-2"><strong>Entreprise :</strong> {{ $stand->user->nom_entreprise ?? 'N/A' }}</p>
    </div>
    <h3 class="text-xl font-semibold text-violet-700 dark:text-violet-200 mb-4">Produits proposés</h3>
    @if($stand->produits->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Aucun produit pour ce stand.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($stand->produits as $produit)
                <a href="{{ route('produits.show_public', $produit->id) }}" class="bg-white dark:bg-gray-900 rounded-xl shadow p-4 flex flex-col hover:shadow-violet-300 border border-violet-50 dark:border-violet-900 transition text-inherit no-underline">
                    @if($produit->image_url)
                        <img src="{{ $produit->image_url }}" alt="Image produit" class="object-cover mx-auto mb-4 rounded max-h-32">
                    @endif
                    <h4 class="text-lg font-bold text-violet-800 dark:text-violet-300 mb-1">{{ $produit->nom }}</h4>
                    <p class="text-gray-600 dark:text-gray-300 mb-2">{{ $produit->description }}</p>
                    <p class="text-violet-600 dark:text-violet-400 font-semibold">{{ number_format($produit->prix, 2, ',', ' ') }} €</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
