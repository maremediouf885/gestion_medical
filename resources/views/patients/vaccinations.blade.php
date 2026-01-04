<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historique Vaccinations - {{ $patient->nom }} {{ $patient->prenom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <p><strong>Patient :</strong> {{ $patient->nom }} {{ $patient->prenom }}</p>
                        <p><strong>N° Patient :</strong> {{ $patient->numero_patient }}</p>
                        <p><strong>Type :</strong> {{ ucfirst($patient->type) }}</p>
                    </div>

                    @if($vaccinations->count() > 0)
                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Date</th>
                                <th class="border p-2">Vaccin</th>
                                <th class="border p-2">Dose</th>
                                <th class="border p-2">Administré par</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vaccinations as $vaccination)
                            <tr>
                                <td class="border p-2">{{ $vaccination->date_vaccination->format('d/m/Y H:i') }}</td>
                                <td class="border p-2">{{ $vaccination->vaccin->nom }}</td>
                                <td class="border p-2">{{ $vaccination->dose }}</td>
                                <td class="border p-2">{{ $vaccination->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-500">Aucune vaccination enregistrée pour ce patient.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('patients.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>