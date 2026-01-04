<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-syringe mr-3"></i>GESTION DES VACCINATIONS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <!-- Bouton Nouvelle Vaccination TRÈS visible -->
                    <div class="mb-8 text-center">
                        <a href="{{ route('vaccinations.create') }}" 
                           style="background: #10b981 !important; color: white !important; padding: 1.5rem 3rem !important; border-radius: 1rem !important; font-size: 1.25rem !important; font-weight: bold !important; text-transform: uppercase !important; box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important; transition: all 0.3s ease !important; display: inline-block !important; text-decoration: none !important;"
                           onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 35px rgba(16, 185, 129, 0.6)';"
                           onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 8px 25px rgba(16, 185, 129, 0.4)';">
                            <i class="fas fa-plus-circle mr-3" style="font-size: 1.5rem !important;"></i>NOUVELLE VACCINATION
                        </a>
                    </div>

                    <!-- Filtres -->
                    <div class="mb-8 bg-gradient-to-r from-blue-50 to-green-50 p-6 rounded-2xl border-2 border-blue-200">
                        <form method="GET" class="flex gap-4 justify-center flex-wrap">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-4 text-blue-500 text-lg"></i>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Rechercher une vaccination..." 
                                       class="medical-input pl-12 w-80 text-lg">
                            </div>
                            <select name="type_patient" class="medical-input text-lg w-48">
                                <option value="">👥 Tous</option>
                                <option value="patient" {{ request('type_patient') == 'patient' ? 'selected' : '' }}>🏥 Patients uniquement</option>
                                <option value="pelerin" {{ request('type_patient') == 'pelerin' ? 'selected' : '' }}>🕌 Pèlerins uniquement</option>
                            </select>
                            <button type="submit" class="btn-primary px-8 py-3 text-lg">
                                <i class="fas fa-filter mr-2"></i>FILTRER
                            </button>
                        </form>
                    </div>

                    <!-- Liste des vaccinations -->
                    @if($vaccinations->count() > 0)
                    <div class="grid gap-6">
                        @foreach($vaccinations as $vaccination)
                        <div class="medical-card p-6 rounded-2xl border-2 border-green-100 hover:border-green-300 transition-all duration-300">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-r from-green-500 to-blue-500 p-4 rounded-full mr-6">
                                        <i class="fas fa-syringe text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-2xl text-gray-800 mb-2">
                                            {{ $vaccination->patient->nom }} {{ $vaccination->patient->prenom }}
                                        </h3>
                                        <div class="flex gap-4 text-lg">
                                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-syringe mr-1"></i>{{ $vaccination->vaccin->nom }}
                                            </span>
                                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full">
                                                <i class="fas fa-calendar mr-1"></i>{{ $vaccination->date_vaccination->format('d/m/Y H:i') }}
                                            </span>
                                            <span class="px-4 py-2 rounded-full font-semibold {{ $vaccination->patient->type == 'pelerin' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                                <i class="fas {{ $vaccination->patient->type == 'pelerin' ? 'fa-kaaba' : 'fa-hospital-user' }} mr-1"></i>
                                                {{ strtoupper($vaccination->patient->type) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-600 mb-2">Dose {{ $vaccination->dose }}</p>
                                    <p class="text-sm text-gray-500">Par {{ $vaccination->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-16">
                        <div class="bg-gradient-to-r from-green-500 to-blue-500 p-8 rounded-full w-32 h-32 mx-auto mb-8 flex items-center justify-center">
                            <i class="fas fa-syringe text-white text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-700 mb-4">Aucune vaccination trouvée</h3>
                        <p class="text-xl text-gray-500 mb-8">Commencez par enregistrer la première vaccination</p>
                        <a href="{{ route('vaccinations.create') }}" 
                           style="background: #10b981 !important; color: white !important; padding: 1.5rem 3rem !important; border-radius: 1rem !important; font-size: 1.5rem !important; font-weight: bold !important; text-transform: uppercase !important; box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important; transition: all 0.3s ease !important; display: inline-block !important; text-decoration: none !important;">
                            <i class="fas fa-plus-circle mr-3"></i>PREMIÈRE VACCINATION
                        </a>
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($vaccinations->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-2xl p-4 shadow-lg">
                            {{ $vaccinations->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>