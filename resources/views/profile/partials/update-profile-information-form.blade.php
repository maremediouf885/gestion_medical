<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Photo de profil -->
        <div>
            <label class="block text-lg font-bold text-gray-700 mb-3">
                <i class="fas fa-camera mr-2"></i>Photo de profil
            </label>
            <div class="flex items-center gap-6">
                <div class="relative">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" 
                             class="w-20 h-20 rounded-full object-cover border-2 border-blue-300" id="preview-image">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gradient-to-r from-blue-400 to-purple-400 flex items-center justify-center border-2 border-blue-300" id="preview-placeholder">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <img class="w-20 h-20 rounded-full object-cover border-2 border-blue-300 hidden" id="preview-image">
                    @endif
                </div>
                <div>
                    <input type="file" name="photo" id="photo" accept="image/*" 
                           class="medical-input text-lg" onchange="previewPhoto(event)">
                    <p class="text-sm text-gray-500 mt-1">JPG, PNG, GIF (max 2MB)</p>
                    @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div>
            <label class="block text-lg font-bold text-gray-700 mb-3">
                <i class="fas fa-user mr-2"></i>Nom complet
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                   class="medical-input w-full text-lg" placeholder="Dr. Nom Prénom">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-lg font-bold text-gray-700 mb-3">
                <i class="fas fa-envelope mr-2"></i>Adresse email
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                   class="medical-input w-full text-lg" placeholder="admin@gestion-medical.com">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="btn-success px-8 py-3 text-lg">
                <i class="fas fa-save mr-2"></i>ENREGISTRER
            </button>
            
            @if (session('status') === 'profile-updated')
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg">
                    <i class="fas fa-check mr-2"></i>Profil mis à jour avec succès !
                </div>
            @endif
        </div>
    </form>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('preview-image');
                    const previewPlaceholder = document.getElementById('preview-placeholder');
                    
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    if (previewPlaceholder) {
                        previewPlaceholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</section>
