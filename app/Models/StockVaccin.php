<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockVaccin extends Model
{
    protected $fillable = [
        'vaccin_id',
        'quantite_recue',
        'quantite_utilisee',
        'source',
        'date_reception',
        'lot',
        'date_expiration'
    ];

    protected $casts = [
        'quantite_recue' => 'integer',
        'quantite_utilisee' => 'integer',
        'date_reception' => 'date',
        'date_expiration' => 'date'
    ];

    public function vaccin()
    {
        return $this->belongsTo(Vaccin::class);
    }

    public function getQuantiteDisponibleAttribute()
    {
        return $this->quantite_recue - $this->quantite_utilisee;
    }
}
