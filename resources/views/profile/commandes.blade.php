@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes commandes</h1>
    @if($commandes->isEmpty())
        <p>Vous n'avez passé aucune commande pour le moment.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Stand</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->date_commande }}</td>
                        <td>{{ $commande->stand->nom_stand ?? '-' }}</td>
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
@endsection
