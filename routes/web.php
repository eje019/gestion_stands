<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;


// Route publique pour la liste des stands
Route::get('/', [\App\Http\Controllers\StandController::class, 'index'])->name('stands.index');

// Route publique pour afficher un stand et ses produits
Route::get('/stands/{id}', [\App\Http\Controllers\StandController::class, 'show'])->name('stands.show');

// Route publique pour la fiche d'un produit
Route::get('/produits/{id}', [\App\Http\Controllers\ProduitController::class, 'show'])->name('produits.show_public');

// Page attente validation entrepreneur
Route::get('/attente-validation', function () {
    return view('attente-validation');
})->name('attente.validation');

// Commandes (admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/commandes', [\App\Http\Controllers\AdminController::class, 'commandes'])->name('admin.commandes');
});

// Historique commandes utilisateur
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/commandes', [\App\Http\Controllers\ProfileController::class, 'commandes'])->name('profile.commandes');
});

// Recherche stands/produits
Route::get('/recherche', [\App\Http\Controllers\StandController::class, 'recherche'])->name('recherche');

// Routes panier (public)
Route::get('/panier', [\App\Http\Controllers\PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter/{id}', [\App\Http\Controllers\PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::post('/panier/modifier/{id}', [\App\Http\Controllers\PanierController::class, 'modifier'])->name('panier.modifier');
Route::post('/panier/supprimer/{id}', [\App\Http\Controllers\PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::post('/panier/valider', [\App\Http\Controllers\PanierController::class, 'valider'])->name('panier.valider');

Route::get('/dashboard', function () {
    $demandes = User::where('role', 'entrepreneur_en_attente')->get();
    return view('dashboard', compact('demandes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Groupe de routes pour l'administration (protégé par middleware 'auth' et vérification du rôle admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/demandes', [\App\Http\Controllers\AdminController::class, 'demandes'])->name('demandes');
    Route::post('/demandes/{id}/approuver', [\App\Http\Controllers\AdminController::class, 'approuver'])->name('demandes.approuver');
    Route::post('/demandes/{id}/refuser', [\App\Http\Controllers\AdminController::class, 'refuser'])->name('demandes.refuser');
});

// Groupe de routes pour la gestion des produits (protégé par middleware 'auth' et rôle entrepreneur approuvé)
Route::middleware(['auth', 'entrepreneur'])->prefix('produits')->name('produits.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProduitController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\ProduitController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\ProduitController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [\App\Http\Controllers\ProduitController::class, 'edit'])->name('edit');
    Route::put('/{id}', [\App\Http\Controllers\ProduitController::class, 'update'])->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\ProduitController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
