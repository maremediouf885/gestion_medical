<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\StockVaccinController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\Admin\PersonnelController as AdminPersonnelController;
use App\Http\Controllers\Personnel\ConsultationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    $vaccinationsDuJour = App\Models\Vaccination::whereDate('date_vaccination', today())->count();
    $stockFaible = App\Models\Vaccin::with('stocks')
        ->get()
        ->filter(function($vaccin) {
            return $vaccin->stock_disponible < 10;
        })
        ->count();
    $rdvAVenir = App\Models\RendezVous::where('date_rdv', '>=', today())
        ->whereIn('statut', ['programme', 'confirme'])
        ->count();
    
    return view('dashboard', compact('vaccinationsDuJour', 'stockFaible', 'rdvAVenir'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour admin
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('personnel', AdminPersonnelController::class);
    });
    
    // Routes pour personnel
    Route::middleware('personnel')->prefix('personnel')->name('personnel.')->group(function () {
        Route::resource('consultations', ConsultationController::class);
    });
    
    Route::resource('patients', PatientController::class);
    Route::get('patients/{patient}/vaccinations', [PatientController::class, 'vaccinations'])->name('patients.vaccinations');
    Route::resource('vaccinations', VaccinationController::class);
    Route::resource('rendez-vous', RendezVousController::class);
    Route::resource('stock-vaccins', StockVaccinController::class);
    Route::resource('personnel', PersonnelController::class);
});

require __DIR__.'/auth.php';
