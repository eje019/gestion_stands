<x-mail::message>
# Refus de votre inscription

Bonjour {{ $user->nom_entreprise ?? $user->name }},

Nous sommes au regret de vous informer que votre demande d'inscription en tant qu'entrepreneur sur la plateforme Eat&Drink a été refusée.

**Motif du refus :**
{{ $motif }}

Si vous souhaitez plus d'informations, n'hésitez pas à nous contacter.

Merci de votre compréhension.

Cordialement,
L'équipe {{ config('app.name') }}
</x-mail::message>
