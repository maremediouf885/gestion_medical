<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl leading-tight text-white">
            <i class="fas fa-users-cog mr-3"></i>GESTION DU PERSONNEL
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="medical-card overflow-hidden shadow-2xl rounded-2xl">
                <div class="p-8">
                    <!-- Bouton Ajouter Personnel TRÈS visible -->
                    <div class="mb-8 text-center">
                        <a href="{{ route('personnel.create') }}" 
                           class="inline-block px-12 py-6 text-2xl text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 uppercase" 
                           style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4); text-decoration: none;">
                            <i class="fas fa-user-plus mr-3" style="font-size: 1.5rem;"></i>AJOUTER PERSONNEL
                        </a>
                    </div>

                    <!-- Liste du personnel -->
                    @if($personnel->count() > 0)
                    <div class="grid gap-6">
                        @foreach($personnel as $member)
                        <div class="medical-card p-6 rounded-2xl border-2 border-green-100 hover:border-green-300 transition-all duration-300">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-r from-green-500 to-blue-500 p-4 rounded-full mr-6">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                                 class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <i class="fas fa-user-nurse text-white text-2xl"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-2xl text-gray-800 mb-2">{{ $member->name }}</h3>
                                        <div class="flex gap-4 text-lg">
                                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-envelope mr-1"></i>{{ $member->email }}
                                            </span>
                                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                                                <i class="fas fa-user-tag mr-1"></i>Personnel
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('personnel.edit', $member) }}" 
                                       class="btn-primary px-6 py-3 text-lg">
                                        <i class="fas fa-edit mr-2"></i>MODIFIER
                                    </a>
                                    <form method="POST" action="{{ route('personnel.destroy', $member) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-danger px-6 py-3 text-lg" 
                                                onclick="return confirm('Supprimer ce membre du personnel ?')">
                                            <i class="fas fa-trash mr-2"></i>SUPPRIMER
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-16">
                        <div class="bg-gradient-to-r from-green-500 to-blue-500 p-8 rounded-full w-32 h-32 mx-auto mb-8 flex items-center justify-center">
                            <i class="fas fa-users-cog text-white text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-700 mb-4">Aucun personnel trouvé</h3>
                        <p class="text-xl text-gray-500 mb-8">Commencez par ajouter votre premier membre du personnel</p>
                        <a href="{{ route('personnel.create') }}" 
                           class="inline-block px-12 py-6 text-2xl text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 uppercase" 
                           style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4); text-decoration: none;">
                            <i class="fas fa-user-plus mr-3"></i>PREMIER PERSONNEL
                        </a>
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($personnel->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-2xl p-4 shadow-lg">
                            {{ $personnel->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>