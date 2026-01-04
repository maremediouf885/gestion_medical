<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

trait SecureMedicalData
{
    use SoftDeletes;

    protected static function bootSecureMedicalData()
    {
        // Empêcher la suppression définitive
        static::deleting(function ($model) {
            if (!Auth::user() || !Auth::user()->is_admin) {
                throw new \Exception('Suppression non autorisée pour les données médicales');
            }
        });

        // Logger les modifications
        static::updating(function ($model) {
            \Log::info('Modification données médicales', [
                'model' => get_class($model),
                'id' => $model->id,
                'user_id' => Auth::id(),
                'changes' => $model->getDirty()
            ]);
        });
    }

    // Empêcher forceDelete pour tous sauf super admin
    public function forceDelete()
    {
        if (!Auth::user() || !Auth::user()->is_super_admin) {
            throw new \Exception('Suppression définitive interdite');
        }
        return parent::forceDelete();
    }
}