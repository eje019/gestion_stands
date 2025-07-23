@extends('layouts.app')

@section('content')
<div class="container">
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
