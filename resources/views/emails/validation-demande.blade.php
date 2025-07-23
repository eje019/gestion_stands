<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre compte Eat&Drink est validé !</title>
</head>
<body style="background:#18181b;color:#222;font-family:sans-serif;padding:2rem;">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:1rem;padding:2rem;box-shadow:0 2px 8px #0001;">
        <h2 style="color:#7c3aed;">Félicitations {{ $user->name ?? $user->nom_entreprise }} !</h2>
        <p>Votre inscription sur <strong>Eat&Drink</strong> a été <span style="color:#16a34a;font-weight:bold;">approuvée</span> par l’équipe d’administration.</p>
        <p>Vous pouvez dès à présent accéder à votre espace personnel, ajouter vos produits, et gérer votre stand.</p>
        <p style="margin-top:2rem;color:#666;font-size:0.95em;">Merci de faire partie de l’aventure Eat&Drink !<br>L’équipe Eat&Drink</p>
    </div>
</body>
</html>
