<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier Patient - {{ $patient->nom }} {{ $patient->prenom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('patients.update', $patient) }}">
                        @csrf @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Nom *</label>
                            <input type="text" name="nom" value="{{ old('nom', $patient->nom) }}" required 
                                   class="w-full border rounded px-3 py-2">
                            @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Prénom *</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $patient->prenom) }}" required 
                                   class="w-full border rounded px-3 py-2">
                            @error('prenom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Date de naissance *</label>
                            <input type="date" name="date_naissance" value="{{ old('date_naissance', $patient->date_naissance->format('Y-m-d')) }}" required 
                                   class="w-full border rounded px-3 py-2">
                            @error('date_naissance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Sexe *</label>
                            <select name="sexe" required class="w-full border rounded px-3 py-2">
                                <option value="">Sélectionner</option>
                                <option value="M" {{ old('sexe', $patient->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('sexe', $patient->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            @error('sexe') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Téléphone</label>
                            <input type="text" name="telephone" value="{{ old('telephone', $patient->telephone) }}" 
                                   class="w-full border rounded px-3 py-2">
                            @error('telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Adresse</label>
                            <textarea name="adresse" class="w-full border rounded px-3 py-2" rows="3">{{ old('adresse', $patient->adresse) }}</textarea>
                            @error('adresse') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Type *</label>
                            <select name="type" required class="w-full border rounded px-3 py-2">
                                <option value="">Sélectionner</option>
                                <option value="patient" {{ old('type', $patient->type) == 'patient' ? 'selected' : '' }}>Patient</option>
                                <option value="pelerin" {{ old('type', $patient->type) == 'pelerin' ? 'selected' : '' }}>Pèlerin</option>
                            </select>
                            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Modifier
                            </button>
                            <a href="{{ route('patients.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>