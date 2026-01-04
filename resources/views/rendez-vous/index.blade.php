<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agenda - {{ $date->format('d/m/Y') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex gap-2">
                            <a href="{{ route('rendez-vous.index', ['date' => $date->subDay()->format('Y-m-d')]) }}" 
                               class="bg-gray-500 text-white px-3 py-1 rounded">← Jour précédent</a>
                            <form method="GET" class="inline">
                                <input type="date" name="date" value="{{ $date->format('Y-m-d') }}" 
                                       onchange="this.form.submit()" class="border rounded px-3 py-1">
                            </form>
                            <a href="{{ route('rendez-vous.index', ['date' => $date->addDay()->format('Y-m-d')]) }}" 
                               class="bg-gray-500 text-white px-3 py-1 rounded">Jour suivant →</a>
                        </div>
                        <a href="{{ route('rendez-vous.create') }}" class="px-8 py-3 text-lg text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105" 
                           style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4); text-decoration: none;">
                            <i class="fas fa-calendar-plus mr-2"></i>NOUVEAU RENDEZ-VOUS
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-2">
                        @php
                            $heures = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
                                      '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];
                        @endphp
                        
                        @foreach($heures as $heure)
                        @php
                            $rdv = $rendezVous->firstWhere('heure_rdv', $heure.':00');
                        @endphp
                        <div class="flex border rounded p-2 {{ $rdv ? 'bg-blue-50' : 'bg-gray-50' }}">
                            <div class="w-20 font-medium">{{ $heure }}</div>
                            <div class="flex-1">
                                @if($rdv)
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <strong>{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</strong>
                                            <br><small>{{ $rdv->motif }}</small>
                                            <br><span class="text-xs px-2 py-1 rounded 
                                                {{ $rdv->statut == 'confirme' ? 'bg-green-200' : 
                                                   ($rdv->statut == 'annule' ? 'bg-red-200' : 'bg-yellow-200') }}">
                                                {{ ucfirst($rdv->statut) }}
                                            </span>
                                        </div>
                                        <a href="{{ route('rendez-vous.edit', $rdv) }}" class="text-blue-600">Modifier</a>
                                    </div>
                                @else
                                    <span class="text-gray-400">Libre</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>