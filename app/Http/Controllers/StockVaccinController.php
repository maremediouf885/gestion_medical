<?php

namespace App\Http\Controllers;

use App\Models\StockVaccin;
use App\Models\Vaccin;
use Illuminate\Http\Request;

class StockVaccinController extends Controller
{
    public function index(Request $request)
    {
        $query = StockVaccin::with('vaccin');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('vaccin', function($q) use ($search) {
                $q->where('nom', 'ilike', '%' . $search . '%');
            })->orWhere('source', 'ilike', '%' . $search . '%');
        }
        
        $stocks = $query->orderBy('date_reception', 'desc')->paginate(15);
        return view('stock-vaccins.index', compact('stocks'));
    }

    public function create()
    {
        $vaccins = Vaccin::where('actif', true)->orderBy('nom')->get();
        return view('stock-vaccins.create', compact('vaccins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_vaccin' => 'required|string|max:255',
            'quantite_recue' => 'required|integer|min:1',
            'source' => 'required|string|max:255',
            'date_reception' => 'required|date',
            'lot' => 'nullable|string|max:100',
            'date_expiration' => 'nullable|date|after:today'
        ]);

        // Créer ou récupérer le vaccin
        $vaccin = Vaccin::firstOrCreate(
            ['nom' => $request->nom_vaccin],
            ['type' => 'obligatoire', 'actif' => true]
        );

        // Créer le stock
        StockVaccin::create([
            'vaccin_id' => $vaccin->id,
            'quantite_recue' => $request->quantite_recue,
            'source' => $request->source,
            'date_reception' => $request->date_reception,
            'lot' => $request->lot,
            'date_expiration' => $request->date_expiration
        ]);

        return redirect()->route('stock-vaccins.index')
            ->with('success', 'Stock ajouté avec succès');
    }

    public function edit(StockVaccin $stockVaccin)
    {
        $vaccins = Vaccin::where('actif', true)->orderBy('nom')->get();
        return view('stock-vaccins.edit', compact('stockVaccin', 'vaccins'));
    }

    public function update(Request $request, StockVaccin $stockVaccin)
    {
        $request->validate([
            'vaccin_id' => 'required|exists:vaccins,id',
            'quantite_recue' => 'required|integer|min:1',
            'source' => 'required|string|max:255',
            'date_reception' => 'required|date',
            'lot' => 'nullable|string|max:100',
            'date_expiration' => 'nullable|date|after:today'
        ]);

        $stockVaccin->update($request->all());
        return redirect()->route('stock-vaccins.index')
            ->with('success', 'Stock modifié avec succès');
    }
}
