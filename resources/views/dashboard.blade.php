<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<h2 class="text-2xl font-bold mb-4 text-white">Demandes d'inscription en attente</h2>
@if($demandes->isEmpty())
    <p class="text-gray-400">Aucune demande en attente.</p>
@else
    <div class="overflow-x-auto mb-10">
        <table class="min-w-full bg-violet-900 rounded-xl shadow-lg border-2 border-black">
            <thead>
                <tr class="text-white text-left border-b-2 border-black">
                    <th class="py-3 px-4 border-r border-black">Nom</th>
                    <th class="py-3 px-4 border-r border-black">Email</th>
                    <th class="py-3 px-4 border-r border-black">Entreprise</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $user)
                    <tr class="border-b border-black hover:bg-violet-800 transition">
                        <td class="py-2 px-4 border-r border-black">
                            <form action="{{ route('admin.demandes.approuver', $user->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="text-violet-200 hover:underline hover:text-violet-300 font-bold">{{ $user->name }}</button>
                            </form>
                        </td>
                        <td class="py-2 px-4 text-violet-100 border-r border-black">{{ $user->email }}</td>
                        <td class="py-2 px-4 text-violet-100 border-r border-black">{{ $user->nom_entreprise }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('admin.demandes.approuver', $user->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="px-4 py-1 bg-green-300 hover:bg-green-400 text-black font-semibold rounded-lg shadow border border-black">Approuver</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
