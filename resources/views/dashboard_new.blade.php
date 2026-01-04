<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-hospital mr-3"></i>SYSTÈME DE GESTION MÉDICALE
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-8">
                        <div class="bg-gradient-to-r from-blue-500 to-red-500 p-6 rounded-full mr-6 pulse-medical">
                            <i class="fas fa-user-md text-white text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-4xl font-bold text-gray-800 mb-2">Bienvenue Dr. {{ Auth::user()->name }}</h3>
                            <p class="text-xl text-gray-600">Système de gestion médicale professionnel</p>
                        </div>
                    </div>
                    
                    <!-- Indicateurs clés -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <div class="medical-card bg-gradient-to-r from-blue-500 to-blue-700 p-8 rounded-2xl text-white shadow-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-blue-100 text-lg mb-2">VACCINATIONS DU JOUR</h4>
                                    <p class="text-5xl font-bold">{{ $vaccinationsDuJour }}</p>
                                </div>
                                <i class="fas fa-syringe text-6xl text-blue-200 pulse-medical"></i>
                            </div>
                        </div>
                        
                        <div class="medical-card bg-gradient-to-r from-{{ $stockFaible > 0 ? 'red-500 to-red-700' : 'green-500 to-green-700' }} p-8 rounded-2xl text-white shadow-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-{{ $stockFaible > 0 ? 'red' : 'green' }}-100 text-lg mb-2">STOCK CRITIQUE</h4>
                                    <p class="text-5xl font-bold">{{ $stockFaible }}</p>
                                </div>
                                <i class="fas fa-exclamation-triangle text-6xl text-{{ $stockFaible > 0 ? 'red' : 'green' }}-200 {{ $stockFaible > 0 ? 'pulse-medical' : '' }}"></i>
                            </div>
                        </div>
                        
                        <div class="medical-card bg-gradient-to-r from-purple-500 to-purple-700 p-8 rounded-2xl text-white shadow-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-purple-100 text-lg mb-2">RDV À VENIR</h4>
                                    <p class="text-5xl font-bold">{{ $rdvAVenir }}</p>
                                </div>
                                <i class="fas fa-calendar-check text-6xl text-purple-200 pulse-medical"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation principale -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <a href="{{ route('patients.index') }}" class="medical-card bg-gradient-to-br from-blue-500 to-blue-700 text-white p-8 rounded-2xl text-center group shadow-2xl hover:shadow-3xl transition-all duration-300">
                            <div class="flex flex-col items-center">
                                <div class="bg-white bg-opacity-20 p-6 rounded-full mb-6 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users text-5xl"></i>
                                </div>
                                <h4 class="font-bold text-2xl mb-3">PATIENTS</h4>
                                <p class="text-blue-100 text-lg">Gestion des patients et pèlerins</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('vaccinations.index') }}" class="medical-card bg-gradient-to-br from-blue-500 to-blue-700 text-white p-8 rounded-2xl text-center group shadow-2xl hover:shadow-3xl transition-all duration-300">
                            <div class="flex flex-col items-center">
                                <div class="bg-white bg-opacity-20 p-6 rounded-full mb-6 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-syringe text-5xl"></i>
                                </div>
                                <h4 class="font-bold text-2xl mb-3">VACCINATIONS</h4>
                                <p class="text-blue-100 text-lg">Enregistrer les vaccinations</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('rendez-vous.index') }}" class="medical-card bg-gradient-to-br from-blue-500 to-blue-700 text-white p-8 rounded-2xl text-center group shadow-2xl hover:shadow-3xl transition-all duration-300">
                            <div class="flex flex-col items-center">
                                <div class="bg-white bg-opacity-20 p-6 rounded-full mb-6 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-calendar-alt text-5xl"></i>
                                </div>
                                <h4 class="font-bold text-2xl mb-3">AGENDA</h4>
                                <p class="text-blue-100 text-lg">Gestion des rendez-vous</p>
                            </div>
                        </a>
                        
                        <div class="medical-card bg-gradient-to-br from-blue-500 to-blue-700 text-white p-8 rounded-2xl text-center shadow-2xl">
                            <div class="flex flex-col items-center">
                                <div class="bg-white bg-opacity-20 p-6 rounded-full mb-6">
                                    <i class="fas fa-boxes text-5xl"></i>
                                </div>
                                <h4 class="font-bold text-2xl mb-3">STOCK VACCINS</h4>
                                <p class="text-blue-100 text-lg">Bientôt disponible</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>