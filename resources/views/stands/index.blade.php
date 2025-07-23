@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-violet-700 dark:text-violet-300 text-center">Nos Exposants</h1>
    <form action="{{ route('recherche') }}" method="GET" class="mb-8 flex justify-center">
        <input type="text" name="q" class="w-full max-w-md rounded-l-lg border-0 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-violet-500" placeholder="Rechercher un stand ou un produit..." value="{{ request('q') }}">
        <button type="submit" class="rounded-r-lg px-6 py-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold transition">Rechercher</button>
    </form>
    @if($stands->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">Aucun stand disponible pour le moment.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($stands as $stand)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col justify-between border border-violet-100 dark:border-violet-900 hover:shadow-violet-300 transition">
                    <div>
                        <h2 class="text-xl font-semibold text-violet-800 dark:text-violet-300 mb-2">{{ $stand->nom_stand }}</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $stand->description }}</p>
                        <p class="text-sm text-violet-500 dark:text-violet-400 mb-4">Par : {{ $stand->user->nom_entreprise ?? 'N/A' }}</p>
                    </div>
                    <a href="{{ route('stands.show', $stand->id) }}" class="mt-auto inline-block px-4 py-2 bg-violet-600 hover:bg-violet-800 text-white text-center rounded-lg font-bold shadow transition">Voir les produits</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
