<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Affiche la liste des entrepreneurs en attente
    public function demandes()
    {
        $demandes = User::where('role', 'entrepreneur_en_attente')->get();
        return view('admin.demandes', compact('demandes'));
    }

    // Approuve une demande
    public function approuver($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'entrepreneur_approuve';
        $user->save();
        return redirect()->route('admin.demandes')->with('success', 'Demande approuvée avec succès.');
    }

    // (Bonus) Refuse une demande
    public function refuser($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Ou autre logique de refus
        return redirect()->route('admin.demandes')->with('error', 'Demande refusée.');
    }
}
