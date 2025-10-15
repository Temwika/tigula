<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Farmer;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\GrainType;
use App\Models\Depot;
use Illuminate\Database\Eloquent\Model;

class AuditLogObserver
{
    /**
     * Handle the Model "creating" event.
     */
    public function creating(Model $model): void
    {
        // Log creation
        AuditLog::log('created', $model);
    }

    /**
     * Handle the Model "updating" event.
     */
    public function updating(Model $model): void
    {
        $changes = [];
        $original = $model->getOriginal();

        foreach ($model->getDirty() as $attribute => $newValue) {
            $oldValue = $original[$attribute] ?? null;
            if ($oldValue != $newValue) {
                $changes[$attribute] = [
                    'from' => $oldValue,
                    'to' => $newValue
                ];
            }
        }

        if (!empty($changes)) {
            AuditLog::log('updated', $model, $original, $model->toArray());
        }
    }

    /**
     * Handle the Model "deleting" event.
     */
    public function deleting(Model $model): void
    {
        // Log deletion
        AuditLog::log('deleted', $model, $model->toArray());
    }

    /**
     * Register the observer for all auditable models
     */
    public static function registerObservers(): void
    {
        // Register observers for auditable models
        Farmer::observe(self::class);
        Transaction::observe(self::class);
        Payment::observe(self::class);
        GrainType::observe(self::class);
        Depot::observe(self::class);
    }
}
