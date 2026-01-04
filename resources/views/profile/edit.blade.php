<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-user-cog mr-3"></i>PROFIL ADMINISTRATEUR
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Photo de profil -->
            <div class="medical-card p-8 shadow-2xl rounded-2xl">
                <div class="text-center mb-8">
                    <div class="relative inline-block">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-blue-500 shadow-lg">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center border-4 border-blue-500 shadow-lg">
                                <i class="fas fa-user-md text-white text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mt-4">Dr. {{ $user->name }}</h3>
                    <p class="text-gray-600">Administrateur du système</p>
                </div>
            </div>

            <!-- Informations du profil -->
            <div class="medical-card p-8 shadow-2xl rounded-2xl">
                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-edit mr-2"></i>Informations personnelles
                </h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Mot de passe -->
            <div class="medical-card p-8 shadow-2xl rounded-2xl">
                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-lock mr-2"></i>Sécurité
                </h3>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Suppression du compte -->
            <div class="medical-card p-8 shadow-2xl rounded-2xl border-2 border-red-200">
                <h3 class="text-xl font-bold text-red-600 mb-6">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Zone dangereuse
                </h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
