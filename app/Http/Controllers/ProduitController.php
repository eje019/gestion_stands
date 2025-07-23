<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    // Affiche la liste des produits de l'entrepreneur connecté
    public function index()
    {
        $user = Auth::user();
        $produits = $user->stand ? $user->stand->produits : collect();
        return view('produits.index', compact('produits'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('produits.create');
    }

    // Enregistre un nouveau produit
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
        ]);
        $produit = new Produit($request->all());
        $produit->stand_id = $user->stand->id;
        $produit->save();
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $this->authorizeProduit($produit);
        return view('produits.edit', compact('produit'));
    }

    // Met à jour un produit
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $this->authorizeProduit($produit);
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
        ]);
        $produit->update($request->all());
        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
    }

    // Supprime un produit
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $this->authorizeProduit($produit);
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }

    // Affiche la fiche d'un produit (publique)
    public function show($id)
    {
        $produit = \App\Models\Produit::with('stand.user')->findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    // Vérifie que l'utilisateur connecté peut gérer ce produit
    private function authorizeProduit(Produit $produit)
    {
        $user = Auth::user();
        if (!$user->stand || $produit->stand_id !== $user->stand->id) {
            abort(403, 'Accès interdit');
        }
    }
}
