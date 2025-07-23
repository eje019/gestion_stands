@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
    <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 font-semibold rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        Accueil
    </a>
    <h1 class="text-3xl font-bold text-violet-700 dark:text-violet-300 text-center flex-1">Mes produits</h1>
</div>
    <a href="{{ route('produits.create') }}" class="mb-6 inline-block px-6 py-2 bg-violet-600 hover:bg-violet-800 text-white font-bold rounded-lg shadow transition">+ Ajouter un produit</a>
    @if($produits->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">Aucun produit enregistré.</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow mb-4">
            <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg">
                <thead>
                    <tr class="bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-200">
                        <th class="py-3 px-2">Nom</th>
                        <th class="py-3 px-2">Description</th>
                        <th class="py-3 px-2">Prix</th>
                        <th class="py-3 px-2">Image</th>
                        <th class="py-3 px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="py-2 px-2 font-semibold">{{ $produit->nom }}</td>
                            <td class="py-2 px-2">{{ $produit->description }}</td>
                            <td class="py-2 px-2">{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                            <td class="py-2 px-2">
                                @if($produit->image_path)
    <img src="{{ asset('storage/'.$produit->image_path) }}" alt="Image" class="object-cover rounded shadow max-h-16 max-w-16 mx-auto">
@elseif($produit->image_url)
    <img src="{{ $produit->image_url }}" alt="Image" class="object-cover rounded shadow max-h-16 max-w-16 mx-auto">
@else
    <span class="text-gray-400">—</span>
@endif
                            </td>
                            <td class="py-2 px-2 flex flex-col sm:flex-row gap-2 items-center justify-center">
                                <a href="{{ route('produits.edit', $produit->id) }}" class="px-4 py-1 bg-yellow-300 hover:bg-yellow-400 text-yellow-900 font-bold rounded-lg shadow transition">Modifier</a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-1 bg-red-400 hover:bg-red-600 text-white font-bold rounded-lg shadow transition">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
