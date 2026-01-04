<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <i class="fas fa-users mr-2"></i>Gestion des Patients
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex gap-2">
                            <form method="GET" class="flex gap-2">
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           placeholder="Rechercher..." class="pl-10 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 transition-all">
                                </div>
                                <select name="type" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 transition-all">
                                    <option value="">Tous types</option>
                                    <option value="pelerin" {{ request('type') == 'pelerin' ? 'selected' : '' }}>Pèlerins uniquement</option>
                                    <option value="patient" {{ request('type') == 'patient' ? 'selected' : '' }}>Patients uniquement</option>
                                </select>
                                <button type="submit" class="medical-btn bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-search mr-2"></i>Rechercher
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('patients.create') }}" class="medical-btn bg-gradient-to-r from-green-500 to-green-700 text-white px-6 py-2 rounded-lg">
                            <i class="fas fa-plus mr-2"></i>Nouveau Patient
                        </a>
                    </div>

                    <div class="medical-card rounded-lg overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="border-b p-4 text-left font-semibold text-gray-700">
                                        <i class="fas fa-hashtag mr-2"></i>N° Patient
                                    </th>
                                    <th class="border-b p-4 text-left font-semibold text-gray-700">
                                        <i class="fas fa-user mr-2"></i>Nom
                                    </th>
                                    <th class="border-b p-4 text-left font-semibold text-gray-700">
                                        <i class="fas fa-user mr-2"></i>Prénom
                                    </th>
                                    <th class="border-b p-4 text-left font-semibold text-gray-700">
                                        <i class="fas fa-phone mr-2"></i>Téléphone
                                    </th>
                                    <th class="border-b p-4 text-left font-semibold text-gray-700">
                                        <i class="fas fa-tag mr-2"></i>Type
                                    </th>
                                    <th class="border-b p-4 text-left font-semibold text-gray-700">
                                        <i class="fas fa-cogs mr-2"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                <tr class="hover:bg-blue-50 transition-colors {{ !$patient->actif ? 'bg-red-50 opacity-75' : '' }}">
                                    <td class="border-b p-4">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                                            {{ $patient->numero_patient }}
                                        </span>
                                    </td>
                                    <td class="border-b p-4 font-medium">{{ $patient->nom }}</td>
                                    <td class="border-b p-4">{{ $patient->prenom }}</td>
                                    <td class="border-b p-4">
                                        @if($patient->telephone)
                                            <i class="fas fa-phone text-green-500 mr-1"></i>{{ $patient->telephone }}
                                        @else
                                            <span class="text-gray-400">Non renseigné</span>
                                        @endif
                                    </td>
                                    <td class="border-b p-4">
                                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                            {{ $patient->type == 'pelerin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                            <i class="fas {{ $patient->type == 'pelerin' ? 'fa-kaaba' : 'fa-user-injured' }} mr-1"></i>
                                            {{ ucfirst($patient->type) }}
                                        </span>
                                    </td>
                                    <td class="border-b p-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('patients.edit', $patient) }}" 
                                               class="medical-btn bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                                <i class="fas fa-edit mr-1"></i>Modifier
                                            </a>
                                            <a href="{{ route('patients.vaccinations', $patient) }}" 
                                               class="medical-btn bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                                                <i class="fas fa-syringe mr-1"></i>Vaccinations
                                            </a>
                                            @if($patient->actif)
                                            <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="medical-btn bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600" 
                                                        onclick="return confirm('Désactiver ce patient ?')">
                                                    <i class="fas fa-ban mr-1"></i>Désactiver
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>