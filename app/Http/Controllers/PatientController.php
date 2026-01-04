<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'ilike', '%' . $search . '%')
                  ->orWhere('prenom', 'ilike', '%' . $search . '%')
                  ->orWhere('telephone', 'ilike', '%' . $search . '%')
                  ->orWhere('numero_patient', 'ilike', '%' . $search . '%');
            });
        }
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        $patients = $query->where('actif', true)->orderBy('nom')->paginate(15);
        return view('patients.index_simple', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'type' => 'required|in:patient,pelerin'
        ]);

        $data = $request->all();
        $data['numero_patient'] = 'P' . str_pad(Patient::count() + 1, 6, '0', STR_PAD_LEFT);
        
        Patient::create($data);
        return redirect()->route('patients.index')->with('success', 'Patient créé avec succès');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'type' => 'required|in:patient,pelerin'
        ]);

        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient modifié avec succès');
    }

    public function destroy(Patient $patient)
    {
        $patient->update(['actif' => false]);
        return redirect()->route('patients.index')->with('success', 'Patient désactivé avec succès');
    }

    public function vaccinations(Patient $patient)
    {
        $vaccinations = $patient->vaccinations()->with(['vaccin', 'user'])
            ->orderBy('date_vaccination', 'desc')
            ->get();
        return view('patients.vaccinations', compact('patient', 'vaccinations'));
    }
}
