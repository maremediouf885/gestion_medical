<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouvelle Vaccination
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('vaccinations.store') }}">
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
                            <label class="block text-sm font-medium mb-2">Vaccin *</label>
                            <select name="vaccin_id" required class="w-full border rounded px-3 py-2">
                                @foreach($vaccins as $vaccin)
                                <option value="{{ $vaccin->id }}" {{ old('vaccin_id') == $vaccin->id ? 'selected' : '' }}>
                                    {{ $vaccin->nom }} ({{ ucfirst($vaccin->type) }})
                                </option>
                                @endforeach
                            </select>
                            @error('vaccin_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Dose *</label>
                            <input type="number" name="dose" value="{{ old('dose', 1) }}" min="1" required 
                                   class="w-full border rounded px-3 py-2">
                            @error('dose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Date et heure de vaccination *</label>
                            <input type="datetime-local" name="date_vaccination" 
                                   value="{{ old('date_vaccination', now()->format('Y-m-d\\TH:i')) }}" required 
                                   class="w-full border rounded px-3 py-2">
                            @error('date_vaccination') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Enregistrer
                            </button>
                            <a href="{{ route('vaccinations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>