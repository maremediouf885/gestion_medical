<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-user-plus mr-3"></i>NOUVEAU PERSONNEL
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('personnel.store') }}">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-user mr-2"></i>Nom complet *
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                   class="medical-input w-full text-lg" placeholder="Dr. Nom Prénom">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-envelope mr-2"></i>Adresse email *
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                   class="medical-input w-full text-lg" placeholder="personnel@gestion-medical.com">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-lock mr-2"></i>Mot de passe *
                            </label>
                            <input type="password" name="password" required 
                                   class="medical-input w-full text-lg" placeholder="Minimum 8 caractères">
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-8">
                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                <i class="fas fa-lock mr-2"></i>Confirmer le mot de passe *
                            </label>
                            <input type="password" name="password_confirmation" required 
                                   class="medical-input w-full text-lg" placeholder="Répéter le mot de passe">
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-8 py-4 text-xl text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105" 
                                    style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);">
                                <i class="fas fa-save mr-3"></i>CRÉER PERSONNEL
                            </button>
                            <a href="{{ route('personnel.index') }}" class="btn-danger px-8 py-4 text-xl">
                                <i class="fas fa-times mr-3"></i>ANNULER
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>