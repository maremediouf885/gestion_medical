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
                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #ef4444 100%) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-right: 1.5rem !important; animation: pulse 2s infinite !important;">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" 
                                     style="width: 4rem !important; height: 4rem !important; border-radius: 50% !important; object-fit: cover !important;">
                            @else
                                <i class="fas fa-user-md" style="color: white !important; font-size: 2.5rem !important;"></i>
                            @endif
                        </div>
                        <div>
                            <h3 style="font-size: 2.5rem !important; font-weight: bold !important; color: #1f2937 !important; margin-bottom: 0.5rem !important;">Bienvenue Dr. {{ Auth::user()->name }}</h3>
                            <p style="font-size: 1.25rem !important; color: #6b7280 !important;">Système de gestion médicale professionnel</p>
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
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.personnel.index') }}" style="background: #dc2626 !important; color: white !important; padding: 2rem !important; border-radius: 1rem !important; text-align: center !important; box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; transition: all 0.3s ease !important; display: block !important; text-decoration: none !important;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 35px 70px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';">
                            <div style="display: flex !important; flex-direction: column !important; align-items: center !important;">
                                <div style="background: rgba(255,255,255,0.2) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-user-tie" style="font-size: 3rem !important; color: white !important;"></i>
                                </div>
                                <h4 style="font-weight: bold !important; font-size: 1.5rem !important; margin-bottom: 0.75rem !important; color: white !important;">PERSONNEL</h4>
                                <p style="color: #fecaca !important; font-size: 1.125rem !important;">Gestion du personnel médical</p>
                            </div>
                        </a>
                        @endif
                        
                        @if(Auth::user()->isPersonnel())
                        <a href="{{ route('personnel.consultations.index') }}" style="background: #059669 !important; color: white !important; padding: 2rem !important; border-radius: 1rem !important; text-align: center !important; box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; transition: all 0.3s ease !important; display: block !important; text-decoration: none !important;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 35px 70px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';">
                            <div style="display: flex !important; flex-direction: column !important; align-items: center !important;">
                                <div style="background: rgba(255,255,255,0.2) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-stethoscope" style="font-size: 3rem !important; color: white !important;"></i>
                                </div>
                                <h4 style="font-weight: bold !important; font-size: 1.5rem !important; margin-bottom: 0.75rem !important; color: white !important;">CONSULTATIONS</h4>
                                <p style="color: #a7f3d0 !important; font-size: 1.125rem !important;">Enregistrer les consultations</p>
                            </div>
                        </a>
                        @endif
                        <a href="{{ route('patients.index') }}" style="background: #2563eb !important; color: white !important; padding: 2rem !important; border-radius: 1rem !important; text-align: center !important; box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; transition: all 0.3s ease !important; display: block !important; text-decoration: none !important;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 35px 70px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';">
                            <div style="display: flex !important; flex-direction: column !important; align-items: center !important;">
                                <div style="background: rgba(255,255,255,0.2) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-users" style="font-size: 3rem !important; color: white !important;"></i>
                                </div>
                                <h4 style="font-weight: bold !important; font-size: 1.5rem !important; margin-bottom: 0.75rem !important; color: white !important;">PATIENTS</h4>
                                <p style="color: #dbeafe !important; font-size: 1.125rem !important;">Gestion des patients et pèlerins</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('vaccinations.index') }}" style="background: #2563eb !important; color: white !important; padding: 2rem !important; border-radius: 1rem !important; text-align: center !important; box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; transition: all 0.3s ease !important; display: block !important; text-decoration: none !important;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 35px 70px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';">
                            <div style="display: flex !important; flex-direction: column !important; align-items: center !important;">
                                <div style="background: rgba(255,255,255,0.2) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-syringe" style="font-size: 3rem !important; color: white !important;"></i>
                                </div>
                                <h4 style="font-weight: bold !important; font-size: 1.5rem !important; margin-bottom: 0.75rem !important; color: white !important;">VACCINATIONS</h4>
                                <p style="color: #dbeafe !important; font-size: 1.125rem !important;">Enregistrer les vaccinations</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('rendez-vous.index') }}" style="background: #2563eb !important; color: white !important; padding: 2rem !important; border-radius: 1rem !important; text-align: center !important; box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; transition: all 0.3s ease !important; display: block !important; text-decoration: none !important;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 35px 70px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';">
                            <div style="display: flex !important; flex-direction: column !important; align-items: center !important;">
                                <div style="background: rgba(255,255,255,0.2) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-calendar-alt" style="font-size: 3rem !important; color: white !important;"></i>
                                </div>
                                <h4 style="font-weight: bold !important; font-size: 1.5rem !important; margin-bottom: 0.75rem !important; color: white !important;">AGENDA</h4>
                                <p style="color: #dbeafe !important; font-size: 1.125rem !important;">Gestion des rendez-vous</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('stock-vaccins.index') }}" style="background: #2563eb !important; color: white !important; padding: 2rem !important; border-radius: 1rem !important; text-align: center !important; box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; transition: all 0.3s ease !important; display: block !important; text-decoration: none !important;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 35px 70px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';">
                            <div style="display: flex !important; flex-direction: column !important; align-items: center !important;">
                                <div style="background: rgba(255,255,255,0.2) !important; padding: 1.5rem !important; border-radius: 50% !important; margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-boxes" style="font-size: 3rem !important; color: white !important;"></i>
                                </div>
                                <h4 style="font-weight: bold !important; font-size: 1.5rem !important; margin-bottom: 0.75rem !important; color: white !important;">STOCK VACCINS</h4>
                                <p style="color: #dbeafe !important; font-size: 1.125rem !important;">Gestion du stock</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
