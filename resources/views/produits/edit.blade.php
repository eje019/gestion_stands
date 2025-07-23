@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
    <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 font-semibold rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        Accueil
    </a>
    <h1 class="text-2xl font-bold text-violet-700 dark:text-violet-300 text-center flex-1">Modifier le produit</h1>
</div>
    <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label for="nom" class="block mb-1 font-semibold text-violet-700 dark:text-violet-200">Nom</label>
            <input type="text" name="nom" id="nom" class="w-full rounded-lg border-0 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500" value="{{ old('nom', $produit->nom) }}" required>
            @error('nom')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="description" class="block mb-1 font-semibold text-violet-700 dark:text-violet-200">Description</label>
            <textarea name="description" id="description" class="w-full rounded-lg border-0 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500">{{ old('description', $produit->description) }}</textarea>
            @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="prix" class="block mb-1 font-semibold text-violet-700 dark:text-violet-200">Prix (€)</label>
            <input type="number" step="0.01" name="prix" id="prix" class="w-full rounded-lg border-0 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500" value="{{ old('prix', $produit->prix) }}" required>
            @error('prix')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
    <label for="image" class="block mb-1 font-semibold text-violet-700 dark:text-violet-200">Image du produit</label>
    <input type="file" name="image" id="image" accept="image/*" class="w-full rounded-lg border-0 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500">
    @if ($produit->image_path)
        <div class="my-2"><img src="{{ asset('storage/'.$produit->image_path) }}" alt="Image actuelle" class="max-h-32 rounded shadow"></div>
    @endif
    @error('image')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
</div>
        <div class="flex gap-4 justify-center mt-6">
            <button type="submit" class="px-6 py-2 bg-violet-600 hover:bg-violet-800 text-white font-bold rounded-lg shadow transition">Mettre à jour</button>
            <a href="{{ route('produits.index') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 font-bold rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">Annuler</a>
        </div>
    </form>
</div>
@endsection
