<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : now();
        $rendezVous = RendezVous::with('patient')
            ->whereDate('date_rdv', $date)
            ->orderBy('heure_rdv')
            ->get();
        return view('rendez-vous.index', compact('rendezVous', 'date'));
    }

    public function create()
    {
        $patients = Patient::where('actif', true)->orderBy('nom')->get();
        return view('rendez-vous.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_rdv' => 'required|date|after_or_equal:today',
            'heure_rdv' => 'required',
            'motif' => 'required|string'
        ]);

        // Vérifier les conflits
        $conflit = RendezVous::where('date_rdv', $request->date_rdv)
            ->where('heure_rdv', $request->heure_rdv)
            ->whereIn('statut', ['programme', 'confirme'])
            ->exists();

        if ($conflit) {
            return back()->withErrors(['heure_rdv' => 'Ce créneau est déjà pris'])->withInput();
        }

        RendezVous::create($request->all());
        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous créé avec succès');
    }

    public function edit(RendezVous $rendezVous)
    {
        $patients = Patient::where('actif', true)->orderBy('nom')->get();
        return view('rendez-vous.edit', compact('rendezVous', 'patients'));
    }

    public function update(Request $request, RendezVous $rendezVous)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_rdv' => 'required|date',
            'heure_rdv' => 'required',
            'motif' => 'required|string',
            'statut' => 'required|in:programme,confirme,annule,termine'
        ]);

        // Vérifier les conflits (sauf pour ce rendez-vous)
        $conflit = RendezVous::where('date_rdv', $request->date_rdv)
            ->where('heure_rdv', $request->heure_rdv)
            ->where('id', '!=', $rendezVous->id)
            ->whereIn('statut', ['programme', 'confirme'])
            ->exists();

        if ($conflit) {
            return back()->withErrors(['heure_rdv' => 'Ce créneau est déjà pris'])->withInput();
        }

        $rendezVous->update($request->all());
        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous modifié avec succès');
    }
}
