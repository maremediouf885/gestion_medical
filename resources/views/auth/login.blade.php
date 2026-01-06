<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-purple-600 to-blue-800">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        
        <!-- Fond médical animé -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full animate-pulse"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-white opacity-10 rounded-full animate-pulse" style="animation-delay: 1s"></div>
            <div class="absolute bottom-20 left-32 w-12 h-12 bg-white opacity-10 rounded-full animate-pulse" style="animation-delay: 2s"></div>
            <div class="absolute bottom-40 right-40 w-24 h-24 bg-white opacity-10 rounded-full animate-pulse" style="animation-delay: 0.5s"></div>
        </div>
        
        <div class="relative z-10 w-full max-w-md">
            <!-- Logo et titre -->
            <div class="text-center mb-8">
                <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-full w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-heartbeat text-white text-3xl pulse"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Gestion Médicale</h1>
                <p class="text-blue-100">Système de gestion des patients et vaccinations</p>
            </div>
            
            <!-- Formulaire de connexion -->
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-white border-opacity-20">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Login (Email ou Username) -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-white mb-2">
                            <i class="fas fa-user mr-2"></i>Email ou Nom d'utilisateur
                        </label>
                        <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                               class="w-full px-4 py-3 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all"
                               placeholder="admin@gestion-medical.com ou admin">
                        <x-input-error :messages="$errors->get('login')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-2">
                            <i class="fas fa-lock mr-2"></i>Mot de passe
                        </label>
                        <input id="password" type="password" name="password" required
                               class="w-full px-4 py-3 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all"
                               placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" 
                               class="w-4 h-4 text-blue-600 bg-white bg-opacity-20 border-white border-opacity-30 rounded focus:ring-blue-500">
                        <label for="remember_me" class="ml-2 text-sm text-blue-100">Se souvenir de moi</label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-3 px-4 rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transform hover:scale-105 transition-all duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </button>
                </form>
                
                <!-- Informations de test -->
                <div class="mt-6 p-4 bg-blue-500 bg-opacity-20 rounded-lg border border-blue-400 border-opacity-30">
                    <h3 class="text-white font-semibold mb-2"><i class="fas fa-info-circle mr-2"></i>Compte de test</h3>
                    <p class="text-blue-100 text-sm">Email: admin@gestion-medical.com</p>
                    <p class="text-blue-100 text-sm">Username: admin</p>
                    <p class="text-blue-100 text-sm">Mot de passe: admin123</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
