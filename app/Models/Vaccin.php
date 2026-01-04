<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccin extends Model
{
    protected $fillable = [
        'nom',
        'type',
        'doses_possibles',
        'actif'
    ];

    protected $casts = [
        'doses_possibles' => 'integer',
        'actif' => 'boolean'
    ];

    const TYPE_OBLIGATOIRE = 'obligatoire';
    const TYPE_RECOMMANDE = 'recommande';
    const TYPE_OPTIONNEL = 'optionnel';

    public static function getTypes()
    {
        return [
            self::TYPE_OBLIGATOIRE => 'Obligatoire',
            self::TYPE_RECOMMANDE => 'Recommandé',
            self::TYPE_OPTIONNEL => 'Optionnel'
        ];
    }

    public function stocks()
    {
        return $this->hasMany(StockVaccin::class);
    }

    public function getStockDisponibleAttribute()
    {
        return $this->stocks->sum(function($stock) {
            return $stock->quantite_disponible;
        });
    }
}
