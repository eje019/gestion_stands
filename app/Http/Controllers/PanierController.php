<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;

class PanierController extends Controller
{
    // Affiche le panier
    public function index()
    {
        $panier = session('panier', []);
        $produits = Produit::whereIn('id', array_keys($panier))->get();
        return view('panier.index', compact('produits', 'panier'));
    }

    // Ajoute un produit au panier
    public function ajouter($id, Request $request)
    {
        $quantite = $request->input('quantite', 1);
        $panier = session('panier', []);
        $panier[$id] = ($panier[$id] ?? 0) + $quantite;
        session(['panier' => $panier]);
        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    // Met à jour la quantité d'un produit
    public function modifier($id, Request $request)
    {
        $quantite = max(1, (int)$request->input('quantite', 1));
        $panier = session('panier', []);
        if(isset($panier[$id])) {
            $panier[$id] = $quantite;
            session(['panier' => $panier]);
        }
        return redirect()->route('panier.index');
    }

    // Supprime un produit du panier
    public function supprimer($id)
    {
        $panier = session('panier', []);
        unset($panier[$id]);
        session(['panier' => $panier]);
        return redirect()->route('panier.index');
    }

    // Valide le panier et crée la commande
    public function valider(Request $request)
    {
        $panier = session('panier', []);
        if (empty($panier)) {
            return redirect()->route('panier.index')->with('success', 'Votre panier est vide.');
        }

        // On regroupe les produits par stand
        $produits = \App\Models\Produit::whereIn('id', array_keys($panier))->get();
        $parStand = [];
        foreach ($produits as $produit) {
            $parStand[$produit->stand_id][] = [
                'produit_id' => $produit->id,
                'nom' => $produit->nom,
                'quantite' => $panier[$produit->id],
                'prix_unitaire' => $produit->prix,
                'total' => $produit->prix * $panier[$produit->id],
            ];
        }

        // Création d'une commande par stand
        foreach ($parStand as $stand_id => $details) {
            \App\Models\Commande::create([
                'stand_id' => $stand_id,
                'user_id' => auth()->id(),
                'details_commande' => json_encode($details, JSON_UNESCAPED_UNICODE),
                'date_commande' => now(),
            ]);
        }

        session()->forget('panier');
        return redirect()->route('panier.index')->with('success', 'Commande enregistrée !');
    }
}
