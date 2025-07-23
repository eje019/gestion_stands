# Eat&Drink – Plateforme de gestion de stands culinaires

## Présentation
Eat&Drink est une application web de gestion d’événement culinaire permettant à des entrepreneurs de proposer leurs stands, aux visiteurs de commander des produits, et à l’administration de gérer l’ensemble du processus.

---

## Fonctionnalités principales

### 1. Gestion des rôles
- **Administrateur** : gère les demandes d’inscription des entrepreneurs, valide ou refuse les stands, visualise les commandes.
- **Entrepreneur** : propose un stand, ajoute/modifie/supprime ses produits, gère ses commandes.
- **Participant (visiteur)** : consulte les stands, ajoute des produits au panier, passe commande, consulte son historique.

### 2. Authentification & Inscription
- Inscription avec nom, email, mot de passe, nom d’entreprise (entrepreneur).
- Authentification sécurisée (Laravel Breeze).
- Attribution automatique du rôle `entrepreneur_en_attente` à l’inscription.

### 3. Gestion des stands
- Création et gestion de stands par les entrepreneurs (après validation admin).
- Listing public des stands avec fiche détaillée.

### 4. Gestion des produits
- CRUD complet pour les produits d’un entrepreneur.
- Upload d’image réelle pour chaque produit (stockée dans `/storage/produits`).
- Affichage des produits par stand et fiche produit publique.

### 5. Panier & Commande
- Panier accessible partout, gestion des quantités, suppression d’articles.
- Validation du panier = création de commandes (une par stand concerné).
- Historique des commandes pour chaque utilisateur.

### 6. Tableau de bord admin
- Liste des demandes d’entrepreneurs en attente.
- Validation/refus avec motif, notification par email.
- Visualisation des commandes par stand.

### 7. Notifications
- Email automatique à l’entrepreneur lors du refus de sa demande (avec motif).

### 8. Interface utilisateur
- Thème violet/dark, responsive, boutons arrondis, navigation rapide.
- Messages d’alerte harmonisés.
- Navigation adaptée selon le rôle.

---

## Identifiants administrateur par défaut

Pour accéder à l’interface d’administration, connectez-vous avec :

- **Email** : `admin@eatdrink.com`
- **Mot de passe** : `admin1234`

Ces identifiants sont créés automatiquement par le seeder `AdminUserSeeder.php`.

---

## Installation rapide

1. **Cloner le dépôt**
2. `composer install`
3. Configurer `.env` (DB_CONNECTION=sqlite recommandé pour local)
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan storage:link` (pour les images uploadées)
7. `php artisan serve`

---

## Parcours utilisateur

- **Entrepreneur** : S’inscrit → attend validation → accède à « Mes Produits » → ajoute/modifie/supprime ses produits (avec image) → visualise ses commandes.
- **Visiteur** : Parcourt les stands et produits → ajoute au panier → passe commande → consulte son historique.
- **Admin** : Se connecte → gère les demandes d’entrepreneurs → visualise les commandes → gère les refus/validations.

---

## Technologies principales
- Laravel 10+
- Breeze (authentification)
- TailwindCSS (front-end)
- SQLite (par défaut, facile à configurer)

---

## Remarques
- Toutes les erreurs et validations sont affichées en français.
- L’upload d’images nécessite le dossier `storage` lié au `public` (`php artisan storage:link`).
- Les images sont stockées dans `storage/app/public/produits` et accessibles via `/storage/produits/...`.
- Pour toute question, se référer au code source ou contacter l’équipe projet.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
