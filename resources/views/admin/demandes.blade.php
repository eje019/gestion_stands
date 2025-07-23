@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex flex-wrap gap-2 mb-6">
    <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 font-semibold rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        Accueil
    </a>
    <a href="{{ route('admin.commandes') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-violet-600 hover:bg-violet-800 text-white font-semibold rounded-lg shadow transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" /></svg>
        Voir commandes
    </a>
    <a href="{{ route('stands.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-200 font-semibold rounded-lg shadow hover:bg-violet-200 dark:hover:bg-violet-800 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8M8 16h8" /></svg>
        Stands publics
    </a>
</div>
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
    <input type="text" name="motif_refus" placeholder="Motif du refus" class="form-control form-control-sm d-inline-block" style="width:120px; margin-right:5px;" required>
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
