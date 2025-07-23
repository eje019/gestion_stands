@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Demandes d'inscription des entrepreneurs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($demandes->isEmpty())
        <p>Aucune demande en attente.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Nom entreprise</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $user)
                    <tr>
                        <td>{{ $user->name ?? $user->nom_entreprise }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nom_entreprise }}</td>
                        <td>
                            <form action="{{ route('admin.demandes.approuver', $user->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                            </form>
                            <form action="{{ route('admin.demandes.refuser', $user->id) }}" method="POST" style="display:inline-block; margin-left:5px;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
