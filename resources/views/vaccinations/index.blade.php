<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vaccinations
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Liste des vaccinations</h3>
                        <a href="{{ route('vaccinations.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                            Nouvelle Vaccination
                        </a>
                    </div>

                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Date</th>
                                <th class="border p-2">Patient</th>
                                <th class="border p-2">Vaccin</th>
                                <th class="border p-2">Dose</th>
                                <th class="border p-2">Administré par</th>
                                <th class="border p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vaccinations as $vaccination)
                            <tr>
                                <td class="border p-2">{{ $vaccination->date_vaccination->format('d/m/Y H:i') }}</td>
                                <td class="border p-2">{{ $vaccination->patient->nom }} {{ $vaccination->patient->prenom }}</td>
                                <td class="border p-2">{{ $vaccination->vaccin->nom }}</td>
                                <td class="border p-2">{{ $vaccination->dose }}</td>
                                <td class="border p-2">{{ $vaccination->user->name }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('vaccinations.show', $vaccination) }}" class="text-blue-600">Voir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $vaccinations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>