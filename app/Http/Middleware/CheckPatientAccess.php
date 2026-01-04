<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Patient;

class CheckPatientAccess
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('patient')) {
            $patient = $request->route('patient');
            if (!$patient instanceof Patient || !$patient->actif) {
                abort(404, 'Patient non trouvé ou inactif');
            }
        }
        
        return $next($request);
    }
}
