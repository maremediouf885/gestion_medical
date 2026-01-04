<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-boxes mr-3"></i>GESTION DU STOCK VACCINS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <!-- Bouton Nouveau Stock -->
                    <div class="mb-8 text-center">
                        <a href="{{ route('stock-vaccins.create') }}" 
                           style="background: #3b82f6 !important; color: white !important; padding: 1.5rem 3rem !important; border-radius: 1rem !important; font-size: 1.25rem !important; font-weight: bold !important; text-transform: uppercase !important; box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; transition: all 0.3s ease !important; display: inline-block !important; text-decoration: none !important;"
                           onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 35px rgba(59, 130, 246, 0.6)';"
                           onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.4)';">
                            <i class="fas fa-plus-circle mr-3" style="font-size: 1.5rem !important;"></i>AJOUTER STOCK
                        </a>
                    </div>

                    <!-- Recherche -->
                    <div class="mb-8 bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-2xl border-2 border-blue-200">
                        <form method="GET" class="flex gap-4 justify-center">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-4 text-blue-500 text-lg"></i>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Rechercher vaccin ou source..." 
                                       class="medical-input pl-12 w-80 text-lg">
                            </div>
                            <button type="submit" class="btn-primary px-8 py-3 text-lg">
                                <i class="fas fa-search mr-2"></i>RECHERCHER
                            </button>
                        </form>
                    </div>

                    <!-- Liste du stock -->
                    @if($stocks->count() > 0)
                    <div class="grid gap-6">
                        @foreach($stocks as $stock)
                        <div class="medical-card p-6 rounded-2xl border-2 border-blue-100 hover:border-blue-300 transition-all duration-300">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-4 rounded-full mr-6">
                                        <i class="fas fa-vial text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-2xl text-gray-800 mb-2">{{ $stock->vaccin->nom }}</h3>
                                        <div class="flex gap-4 text-lg">
                                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-arrow-down mr-1"></i>Reçu: {{ $stock->quantite_recue }}
                                            </span>
                                            <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-arrow-up mr-1"></i>Utilisé: {{ $stock->quantite_utilisee }}
                                            </span>
                                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-box mr-1"></i>Disponible: {{ $stock->quantite_disponible }}
                                            </span>
                                        </div>
                                        <div class="flex gap-4 text-sm text-gray-600 mt-2">
                                            <span><i class="fas fa-truck mr-1"></i>{{ $stock->source }}</span>
                                            <span><i class="fas fa-calendar mr-1"></i>{{ $stock->date_reception->format('d/m/Y') }}</span>
                                            @if($stock->lot)
                                            <span><i class="fas fa-barcode mr-1"></i>Lot: {{ $stock->lot }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('stock-vaccins.edit', $stock) }}" 
                                       class="btn-primary px-6 py-3 text-lg">
                                        <i class="fas fa-edit mr-2"></i>MODIFIER
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-16">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-8 rounded-full w-32 h-32 mx-auto mb-8 flex items-center justify-center">
                            <i class="fas fa-boxes text-white text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-700 mb-4">Aucun stock trouvé</h3>
                        <p class="text-xl text-gray-500 mb-8">Commencez par ajouter du stock de vaccins</p>
                        <a href="{{ route('stock-vaccins.create') }}" 
                           style="background: #3b82f6 !important; color: white !important; padding: 1.5rem 3rem !important; border-radius: 1rem !important; font-size: 1.5rem !important; font-weight: bold !important; text-transform: uppercase !important; box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; transition: all 0.3s ease !important; display: inline-block !important; text-decoration: none !important;">
                            <i class="fas fa-plus-circle mr-3"></i>PREMIER STOCK
                        </a>
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($stocks->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-2xl p-4 shadow-lg">
                            {{ $stocks->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>