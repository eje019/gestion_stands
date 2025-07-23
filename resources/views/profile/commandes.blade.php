@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
    <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 font-semibold rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        Accueil
    </a>
    <h1 class="text-3xl font-bold text-violet-700 dark:text-violet-300 text-center flex-1">Mes commandes</h1>
</div>
    @if($commandes->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">Vous n'avez passé aucune commande pour le moment.</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow mb-4">
            <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg">
                <thead>
                    <tr class="bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-200">
                        <th class="py-3 px-2">Date</th>
                        <th class="py-3 px-2">Stand</th>
                        <th class="py-3 px-2">Détails</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="py-2 px-2">{{ $commande->date_commande }}</td>
                            <td class="py-2 px-2 font-semibold">{{ $commande->stand->nom_stand ?? '-' }}</td>
                            <td class="py-2 px-2">
                                @php $details = json_decode($commande->details_commande, true); @endphp
                                <ul class="list-disc list-inside">
                                    @foreach($details as $item)
                                        <li>
                                            <span class="font-semibold text-violet-700 dark:text-violet-300">{{ $item['nom'] }}</span>
                                            <span class="mx-1">x</span>
                                            <span class="font-semibold">{{ $item['quantite'] }}</span>
                                            <span class="mx-1">à</span>
                                            <span>{{ number_format($item['prix_unitaire'], 2, ',', ' ') }} €</span>
                                            <span class="mx-2 text-gray-400">|</span>
                                            <span class="font-semibold text-violet-600 dark:text-violet-400">Total : {{ number_format($item['total'], 2, ',', ' ') }} €</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
