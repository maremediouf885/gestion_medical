<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with(['patient', 'user'])->where('user_id', auth()->id())->latest()->get();
        return view('personnel.consultations.index', compact('consultations'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('personnel.consultations.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_consultation' => 'required|date',
            'notes' => 'required|string',
        ]);

        Consultation::create([
            'patient_id' => $request->patient_id,
            'user_id' => auth()->id(),
            'date_consultation' => $request->date_consultation,
            'notes' => $request->notes,
        ]);

        return redirect()->route('personnel.consultations.index')->with('success', 'Consultation enregistrée');
    }

    public function show(Consultation $consultation)
    {
        return view('personnel.consultations.show', compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $patients = Patient::all();
        return view('personnel.consultations.edit', compact('consultation', 'patients'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_consultation' => 'required|date',
            'notes' => 'required|string',
        ]);

        $consultation->update($request->all());

        return redirect()->route('personnel.consultations.index')->with('success', 'Consultation mise à jour');
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('personnel.consultations.index')->with('success', 'Consultation supprimée');
    }
}