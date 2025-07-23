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
}
