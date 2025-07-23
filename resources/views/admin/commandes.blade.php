@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex flex-wrap gap-2 mb-6">
    <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 font-semibold rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        Accueil
    </a>
    <a href="{{ route('admin.demandes') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-violet-600 hover:bg-violet-800 text-white font-semibold rounded-lg shadow transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" /></svg>
        Voir demandes
    </a>
    <a href="{{ route('stands.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-200 font-semibold rounded-lg shadow hover:bg-violet-200 dark:hover:bg-violet-800 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8M8 16h8" /></svg>
        Stands publics
    </a>
</div>
<h1>Commandes par stand</h1>
    @foreach($stands as $stand)
        <div class="card mb-4">
            <div class="card-header">
                <strong>{{ $stand->nom_stand }}</strong>
                <span class="text-muted">(Entreprise : {{ $stand->user->nom_entreprise ?? 'N/A' }})</span>
            </div>
            <div class="card-body">
                @if($stand->commandes->isEmpty())
                    <p>Aucune commande pour ce stand.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Détails</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stand->commandes as $commande)
                                <tr>
                                    <td>{{ $commande->date_commande }}</td>
                                    <td>
                                        @php $details = json_decode($commande->details_commande, true); @endphp
                                        <ul>
                                            @foreach($details as $item)
                                                <li>
                                                    {{ $item['nom'] }} x {{ $item['quantite'] }} à {{ number_format($item['prix_unitaire'], 2, ',', ' ') }} € (Total : {{ number_format($item['total'], 2, ',', ' ') }} €)
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
