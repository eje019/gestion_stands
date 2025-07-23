<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    // Affiche la liste publique des stands
    public function index()
    {
        $stands = Stand::with('user')->get();
        return view('stands.index', compact('stands'));
    }

    // Affiche la page d'un stand avec ses produits
    public function show($id)
    {
        $stand = \App\Models\Stand::with('produits', 'user')->findOrFail($id);
        return view('stands.show', compact('stand'));
    }

    // Recherche stands et produits
    public function recherche(Request $request)
    {
        $q = $request->input('q');
        $stands = collect();
        $produits = collect();
        if ($q) {
            $stands = \App\Models\Stand::with('user')
                ->where('nom_stand', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->get();
            $produits = \App\Models\Produit::with('stand.user')
                ->where('nom', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->get();
        }
        return view('recherche', compact('stands', 'produits'));
    }
}
