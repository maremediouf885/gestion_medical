<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-user-md mr-3"></i>GESTION DES PATIENTS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <!-- Bouton Nouveau Patient TRÈS visible -->
                    <div class="mb-8 text-center">
                        <a href="{{ route('patients.create') }}" 
                           class="inline-block btn-primary text-xl px-12 py-6 rounded-2xl shadow-2xl pulse-medical">
                            <i class="fas fa-plus-circle mr-4 text-2xl"></i>NOUVEAU PATIENT
                        </a>
                    </div>

                    <!-- Barre de recherche stylée -->
                    <div class="mb-8 bg-gradient-to-r from-blue-50 to-red-50 p-6 rounded-2xl border-2 border-blue-200">
                        <form method="GET" class="flex gap-4 justify-center flex-wrap">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-4 text-blue-500 text-lg"></i>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Rechercher un patient..." 
                                       class="medical-input pl-12 w-80 text-lg">
                            </div>
                            <select name="type" class="medical-input text-lg w-48">
                                <option value="">📋 Tous types</option>
                                <option value="patient" {{ request('type') == 'patient' ? 'selected' : '' }}>🏥 Patients</option>
                                <option value="pelerin" {{ request('type') == 'pelerin' ? 'selected' : '' }}>🕌 Pèlerins</option>
                            </select>
                            <button type="submit" class="btn-primary px-8 py-3 text-lg">
                                <i class="fas fa-search mr-2"></i>RECHERCHER
                            </button>
                        </form>
                    </div>

                    <!-- Liste des patients -->
                    @if($patients->count() > 0)
                    <div class="grid gap-6">
                        @foreach($patients as $patient)
                        <div class="medical-card p-6 rounded-2xl border-2 border-blue-100 hover:border-blue-300 transition-all duration-300">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-r from-blue-500 to-red-500 p-4 rounded-full mr-6">
                                        <i class="fas {{ $patient->type == 'pelerin' ? 'fa-kaaba' : 'fa-user-injured' }} text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-2xl text-gray-800 mb-2">{{ $patient->nom }} {{ $patient->prenom }}</h3>
                                        <div class="flex gap-4 text-lg">
                                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-hashtag mr-1"></i>{{ $patient->numero_patient }}
                                            </span>
                                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full">
                                                <i class="fas fa-phone mr-1"></i>{{ $patient->telephone ?: 'Non renseigné' }}
                                            </span>
                                            <span class="px-4 py-2 rounded-full font-semibold {{ $patient->type == 'pelerin' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                                <i class="fas {{ $patient->type == 'pelerin' ? 'fa-kaaba' : 'fa-hospital-user' }} mr-1"></i>
                                                {{ strtoupper($patient->type) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('patients.edit', $patient) }}" 
                                       class="btn-primary px-6 py-3 text-lg">
                                        <i class="fas fa-edit mr-2"></i>MODIFIER
                                    </a>
                                    <a href="{{ route('patients.vaccinations', $patient) }}" 
                                       class="btn-success px-6 py-3 text-lg">
                                        <i class="fas fa-syringe mr-2"></i>VACCINATIONS
                                    </a>
                                    @if($patient->actif)
                                    <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-danger px-6 py-3 text-lg" 
                                                onclick="return confirm('Désactiver ce patient ?')">
                                            <i class="fas fa-ban mr-2"></i>DÉSACTIVER
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-16">
                        <div class="bg-gradient-to-r from-blue-500 to-red-500 p-8 rounded-full w-32 h-32 mx-auto mb-8 flex items-center justify-center">
                            <i class="fas fa-user-plus text-white text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-700 mb-4">Aucun patient trouvé</h3>
                        <p class="text-xl text-gray-500 mb-8">Commencez par ajouter votre premier patient au système</p>
                        <a href="{{ route('patients.create') }}" 
                           class="btn-primary text-2xl px-12 py-6 rounded-2xl pulse-medical">
                            <i class="fas fa-plus-circle mr-3"></i>AJOUTER LE PREMIER PATIENT
                        </a>
                    </div>
                    @endif

                    <!-- Pagination stylée -->
                    @if($patients->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-2xl p-4 shadow-lg">
                            {{ $patients->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>