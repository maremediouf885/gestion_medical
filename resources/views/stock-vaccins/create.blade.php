<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-plus-circle mr-3"></i>AJOUTER STOCK VACCIN
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('stock-vaccins.store') }}">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-syringe mr-2"></i>Nom du vaccin *
                            </label>
                            <input type="text" name="nom_vaccin" value="{{ old('nom_vaccin') }}" required 
                                   class="medical-input w-full text-lg" placeholder="Ex: BCG, Polio, Rougeole...">
                            @error('nom_vaccin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-arrow-down mr-2"></i>Quantité reçue *
                            </label>
                            <input type="number" name="quantite_recue" value="{{ old('quantite_recue') }}" min="1" required 
                                   class="medical-input w-full text-lg" placeholder="Nombre de doses reçues">
                            @error('quantite_recue') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-truck mr-2"></i>Source *
                            </label>
                            <input type="text" name="source" value="{{ old('source') }}" required 
                                   class="medical-input w-full text-lg" placeholder="Ex: Pharmacie Centrale, Ministère Santé...">
                            @error('source') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-calendar-alt mr-2"></i>Date de réception *
                            </label>
                            <input type="date" name="date_reception" value="{{ old('date_reception', now()->format('Y-m-d')) }}" required 
                                   class="medical-input w-full text-lg">
                            @error('date_reception') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-barcode mr-2"></i>Numéro de lot (optionnel)
                            </label>
                            <input type="text" name="lot" value="{{ old('lot') }}" 
                                   class="medical-input w-full text-lg" placeholder="Ex: LOT2024001">
                            @error('lot') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-8">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Date d'expiration (optionnel)
                            </label>
                            <input type="date" name="date_expiration" value="{{ old('date_expiration') }}" 
                                   class="medical-input w-full text-lg">
                            @error('date_expiration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="btn-success px-8 py-4 text-xl">
                                <i class="fas fa-save mr-3"></i>ENREGISTRER STOCK
                            </button>
                            <a href="{{ route('stock-vaccins.index') }}" class="btn-danger px-8 py-4 text-xl">
                                <i class="fas fa-times mr-3"></i>ANNULER
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>