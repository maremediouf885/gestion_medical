<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $fillable = [
        'patient_id',
        'date_rdv',
        'heure_rdv',
        'motif',
        'statut'
    ];

    protected $casts = [
        'date_rdv' => 'date',
        'heure_rdv' => 'datetime'
    ];

    const STATUT_PROGRAMME = 'programme';
    const STATUT_CONFIRME = 'confirme';
    const STATUT_ANNULE = 'annule';
    const STATUT_TERMINE = 'termine';

    public static function getStatuts()
    {
        return [
            self::STATUT_PROGRAMME => 'Programmé',
            self::STATUT_CONFIRME => 'Confirmé',
            self::STATUT_ANNULE => 'Annulé',
            self::STATUT_TERMINE => 'Terminé'
        ];
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
