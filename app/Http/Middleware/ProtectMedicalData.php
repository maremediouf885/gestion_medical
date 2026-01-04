<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProtectMedicalData
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier l'authentification
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Logger toutes les actions sur les données médicales
        Log::info('Accès données médicales', [
            'user_id' => Auth::id(),
            'ip' => $request->ip(),
            'route' => $request->route()->getName(),
            'timestamp' => now()
        ]);

        // Bloquer la suppression pour les non-admins
        if ($request->isMethod('delete') && !Auth::user()->is_admin) {
            abort(403, 'Seuls les administrateurs peuvent supprimer des données médicales');
        }

        return $next($request);
    }
}