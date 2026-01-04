<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouveau Rendez-vous
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('rendez-vous.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Patient *</label>
                            <select name="patient_id" required class="w-full border rounded px-3 py-2">
                                <option value="">Sélectionner un patient</option>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->nom }} {{ $patient->prenom }} ({{ $patient->numero_patient }})
                                </option>
                                @endforeach
                            </select>
                            @error('patient_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Date *</label>
                            <input type="date" name="date_rdv" value="{{ old('date_rdv', now()->format('Y-m-d')) }}" required 
                                   class="w-full border rounded px-3 py-2">
                            @error('date_rdv') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Heure *</label>
                            <select name="heure_rdv" required class="w-full border rounded px-3 py-2">
                                <option value="">Sélectionner une heure</option>
                                @foreach(['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
                                         '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'] as $heure)
                                <option value="{{ $heure }}" {{ old('heure_rdv') == $heure ? 'selected' : '' }}>
                                    {{ $heure }}
                                </option>
                                @endforeach
                            </select>
                            @error('heure_rdv') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Motif *</label>
                            <textarea name="motif" required class="w-full border rounded px-3 py-2" rows="3">{{ old('motif') }}</textarea>
                            @error('motif') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="px-8 py-3 text-lg text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105" 
                                    style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);">
                                <i class="fas fa-calendar-plus mr-2"></i>CONFIRMER LE RENDEZ-VOUS
                            </button>
                            <a href="{{ route('rendez-vous.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>