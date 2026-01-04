<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = [
        'patient_id',
        'vaccin_id',
        'dose',
        'date_vaccination',
        'user_id'
    ];

    protected $casts = [
        'date_vaccination' => 'datetime',
        'dose' => 'integer'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function vaccin()
    {
        return $this->belongsTo(Vaccin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
