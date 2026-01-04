<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Patient;
use App\Models\Vaccin;
use App\Models\StockVaccin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    public function index()
    {
        $query = Vaccination::with(['patient', 'vaccin', 'user']);
        
        if (request('search')) {
            $search = request('search');
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('nom', 'ilike', '%' . $search . '%')
                  ->orWhere('prenom', 'ilike', '%' . $search . '%');
            })->orWhereHas('vaccin', function($q) use ($search) {
                $q->where('nom', 'ilike', '%' . $search . '%');
            });
        }
        
        if (request('type_patient')) {
            $query->whereHas('patient', function($q) {
                $q->where('type', request('type_patient'));
            });
        }
        
        $vaccinations = $query->orderBy('date_vaccination', 'desc')->paginate(15);
        return view('vaccinations.index_new', compact('vaccinations'));
    }

    public function create()
    {
        $patients = Patient::where('actif', true)->orderBy('nom')->get();
        $vaccins = Vaccin::where('actif', true)->orderBy('nom')->get();
        return view('vaccinations.create_new', compact('patients', 'vaccins'));
    }

    public function store(Request $request)
    {
        // Validation dynamique selon le mode
        if ($request->filled('vaccin_nom_custom')) {
            $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'vaccin_nom_custom' => 'required|string|max:255',
                'vaccin_type_custom' => 'required|in:obligatoire,recommande,optionnel',
                'dose' => 'required|integer|min:1',
                'date_vaccination' => 'required|date'
            ]);
            
            // Créer ou récupérer le vaccin
            $vaccin = Vaccin::firstOrCreate([
                'nom' => $request->vaccin_nom_custom,
                'type' => $request->vaccin_type_custom
            ], [
                'doses_possibles' => 1,
                'actif' => true
            ]);
            
            $vaccinId = $vaccin->id;
        } else {
            $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'vaccin_id' => 'required|exists:vaccins,id',
                'dose' => 'required|integer|min:1',
                'date_vaccination' => 'required|date'
            ]);
            
            $vaccinId = $request->vaccin_id;
        }

        // Vérifier que le patient est actif
        $patient = Patient::findOrFail($request->patient_id);
        if (!$patient->actif) {
            return back()->withErrors(['patient_id' => 'Ce patient est inactif'])->withInput();
        }

        DB::transaction(function () use ($request, $vaccinId) {
            // Enregistrer la vaccination
            Vaccination::create([
                'patient_id' => $request->patient_id,
                'vaccin_id' => $vaccinId,
                'dose' => $request->dose,
                'date_vaccination' => $request->date_vaccination,
                'user_id' => Auth::id()
            ]);

            // Décrémenter le stock si disponible
            $stock = StockVaccin::where('vaccin_id', $vaccinId)
                ->whereRaw('quantite_recue > quantite_utilisee')
                ->orderBy('date_reception')
                ->first();
                
            if ($stock) {
                $stock->increment('quantite_utilisee');
            }
        });

        return redirect()->route('vaccinations.index')
            ->with('success', 'Vaccination enregistrée avec succès');
    }

    public function show(Vaccination $vaccination)
    {
        $vaccination->load(['patient', 'vaccin', 'user']);
        return view('vaccinations.show', compact('vaccination'));
    }
}
