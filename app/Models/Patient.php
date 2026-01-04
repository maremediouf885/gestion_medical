<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'telephone',
        'adresse',
        'numero_patient',
        'type',
        'actif'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'actif' => 'boolean'
    ];

    const TYPE_PATIENT = 'patient';
    const TYPE_PELERIN = 'pelerin';

    public static function getTypes()
    {
        return [
            self::TYPE_PATIENT => 'Patient',
            self::TYPE_PELERIN => 'Pèlerin'
        ];
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}
