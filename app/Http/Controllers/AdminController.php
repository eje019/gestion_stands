<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RefusDemandeMail;
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
        Mail::to($user->email)->send(new \App\Mail\ValidationDemandeMail($user));
        return redirect()->route('admin.demandes')->with('success', 'Demande approuvée avec succès. Un email de validation a été envoyé.');
    }

    // (Bonus) Refuse une demande
    public function refuser($id, Request $request)
    {
        $user = User::findOrFail($id);
        $motif = $request->input('motif_refus');
        $user->motif_refus = $motif;
        $user->role = 'entrepreneur_refuse';
        $user->save();
        
        Mail::to($user->email)->send(new RefusDemandeMail($user));

        
        return redirect()->route('admin.demandes')->with('error', 'Demande refusée avec motif et notification envoyée.');
    }

    // Affiche les commandes par stand
    public function commandes()
    {
        $stands = \App\Models\Stand::with(['commandes'])->get();
        return view('admin.commandes', compact('stands'));
    }
}
