@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-20 p-10 bg-gray-900 rounded-xl shadow-lg text-center text-gray-100">
        <div class="mb-6 flex justify-center">
            <span class="text-6xl animate-pulse">⏳</span>
        </div>
        <h1 class="text-3xl font-extrabold mb-4 text-violet-400">Demande en attente de validation</h1>
        <p class="mb-4 text-lg">Merci pour votre inscription en tant qu'entrepreneur sur <span class="font-bold text-violet-300">Eat&amp;Drink</span> !</p>
        <p class="mb-4">Votre demande est en cours de vérification par notre équipe.</p>
        <p class="mb-6">Vous recevrez un email dès que votre compte sera <span class="font-semibold text-green-400">activé</span> ou si des informations complémentaires sont nécessaires.</p>
        <p class="text-gray-400 text-sm">Pour toute question, contactez-nous à <a href="mailto:support@eatdrink.com" class="underline text-violet-300">support@eatdrink.com</a>.</p>
    </div>
@endsection
