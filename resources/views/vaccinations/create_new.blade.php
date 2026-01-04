<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-syringe mr-3"></i>NOUVELLE VACCINATION
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('vaccinations.store') }}">
                        @csrf
                        
                        <!-- Filtre par type -->
                        <div class="mb-6 bg-blue-50 p-4 rounded-xl">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-filter mr-2"></i>Filtrer les patients :
                            </label>
                            <div class="flex gap-4">
                                <button type="button" onclick="filterPatients('all')" 
                                        class="filter-btn bg-gray-500 text-white px-4 py-2 rounded-lg" id="btn-all">
                                    👥 Tous
                                </button>
                                <button type="button" onclick="filterPatients('patient')" 
                                        class="filter-btn bg-blue-500 text-white px-4 py-2 rounded-lg" id="btn-patient">
                                    🏥 Patients
                                </button>
                                <button type="button" onclick="filterPatients('pelerin')" 
                                        class="filter-btn bg-purple-500 text-white px-4 py-2 rounded-lg" id="btn-pelerin">
                                    🕌 Pèlerins
                                </button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-user mr-2"></i>Patient *
                            </label>
                            <select name="patient_id" required class="medical-input w-full text-lg" id="patient-select">
                                <option value="">Sélectionner un patient</option>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" data-type="{{ $patient->type }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->nom }} {{ $patient->prenom }} ({{ $patient->numero_patient }}) - 
                                    <span class="font-bold">{{ strtoupper($patient->type) }}</span>
                                </option>
                                @endforeach
                            </select>
                            @error('patient_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-syringe mr-2"></i>Vaccin *
                            </label>
                            <div class="flex gap-4 mb-3">
                                <button type="button" onclick="toggleVaccinMode('select')" 
                                        class="vaccin-mode-btn bg-blue-500 text-white px-4 py-2 rounded-lg" id="btn-select">
                                    📋 Sélectionner
                                </button>
                                <button type="button" onclick="toggleVaccinMode('custom')" 
                                        class="vaccin-mode-btn bg-green-500 text-white px-4 py-2 rounded-lg" id="btn-custom">
                                    ✏️ Saisir manuellement
                                </button>
                            </div>
                            
                            <!-- Mode sélection -->
                            <div id="vaccin-select-mode">
                                <select name="vaccin_id" class="medical-input w-full text-lg" id="vaccin-select">
                                    <option value="">Sélectionner un vaccin existant</option>
                                    @foreach($vaccins as $vaccin)
                                    <option value="{{ $vaccin->id }}" {{ old('vaccin_id') == $vaccin->id ? 'selected' : '' }}>
                                        {{ $vaccin->nom }} ({{ ucfirst($vaccin->type) }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Mode saisie manuelle -->
                            <div id="vaccin-custom-mode" style="display: none;">
                                <input type="text" name="vaccin_nom_custom" placeholder="Nom du vaccin (ex: Hépatite B, COVID-19...)" 
                                       class="medical-input w-full text-lg mb-3" value="{{ old('vaccin_nom_custom') }}">
                                <select name="vaccin_type_custom" class="medical-input w-full text-lg">
                                    <option value="">Type de vaccin</option>
                                    <option value="obligatoire" {{ old('vaccin_type_custom') == 'obligatoire' ? 'selected' : '' }}>Obligatoire</option>
                                    <option value="recommande" {{ old('vaccin_type_custom') == 'recommande' ? 'selected' : '' }}>Recommandé</option>
                                    <option value="optionnel" {{ old('vaccin_type_custom') == 'optionnel' ? 'selected' : '' }}>Optionnel</option>
                                </select>
                            </div>
                            
                            @error('vaccin_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @error('vaccin_nom_custom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @error('vaccin_type_custom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-hashtag mr-2"></i>Dose *
                            </label>
                            <input type="number" name="dose" value="{{ old('dose', 1) }}" min="1" required 
                                   class="medical-input w-full text-lg">
                            @error('dose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-8">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-calendar-alt mr-2"></i>Date et heure de vaccination *
                            </label>
                            <input type="datetime-local" name="date_vaccination" 
                                   value="{{ old('date_vaccination', now()->format('Y-m-d\TH:i')) }}" required 
                                   class="medical-input w-full text-lg">
                            @error('date_vaccination') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="btn-success px-8 py-4 text-xl">
                                <i class="fas fa-save mr-3"></i>ENREGISTRER VACCINATION
                            </button>
                            <a href="{{ route('vaccinations.index') }}" class="btn-danger px-8 py-4 text-xl">
                                <i class="fas fa-times mr-3"></i>ANNULER
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterPatients(type) {
            const select = document.getElementById('patient-select');
            const options = select.querySelectorAll('option');
            
            // Reset button styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.className = 'filter-btn bg-gray-400 text-white px-4 py-2 rounded-lg';
            });
            
            // Highlight active button
            if (type === 'all') {
                document.getElementById('btn-all').className = 'filter-btn bg-gray-600 text-white px-4 py-2 rounded-lg';
            } else if (type === 'patient') {
                document.getElementById('btn-patient').className = 'filter-btn bg-blue-600 text-white px-4 py-2 rounded-lg';
            } else if (type === 'pelerin') {
                document.getElementById('btn-pelerin').className = 'filter-btn bg-purple-600 text-white px-4 py-2 rounded-lg';
            }
            
            // Filter options
            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }
                
                if (type === 'all') {
                    option.style.display = 'block';
                } else {
                    const patientType = option.getAttribute('data-type');
                    option.style.display = patientType === type ? 'block' : 'none';
                }
            });
        }
        
        function toggleVaccinMode(mode) {
            const selectMode = document.getElementById('vaccin-select-mode');
            const customMode = document.getElementById('vaccin-custom-mode');
            const vaccinSelect = document.getElementById('vaccin-select');
            
            // Reset button styles
            document.querySelectorAll('.vaccin-mode-btn').forEach(btn => {
                btn.className = 'vaccin-mode-btn bg-gray-400 text-white px-4 py-2 rounded-lg';
            });
            
            if (mode === 'select') {
                document.getElementById('btn-select').className = 'vaccin-mode-btn bg-blue-600 text-white px-4 py-2 rounded-lg';
                selectMode.style.display = 'block';
                customMode.style.display = 'none';
                vaccinSelect.required = true;
                document.querySelector('input[name="vaccin_nom_custom"]').required = false;
                document.querySelector('select[name="vaccin_type_custom"]').required = false;
            } else {
                document.getElementById('btn-custom').className = 'vaccin-mode-btn bg-green-600 text-white px-4 py-2 rounded-lg';
                selectMode.style.display = 'none';
                customMode.style.display = 'block';
                vaccinSelect.required = false;
                document.querySelector('input[name="vaccin_nom_custom"]').required = true;
                document.querySelector('select[name="vaccin_type_custom"]').required = true;
            }
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            filterPatients('all');
            toggleVaccinMode('select');
        });
    </script>
</x-app-layout>