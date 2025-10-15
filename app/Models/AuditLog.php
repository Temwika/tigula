<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'changes',
        'ip_address',
        'user_agent',
        'notes'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'changes' => 'array',
    ];

    /**
     * Get the user who performed this action
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log an action
     */
    public static function log($action, $model, $oldValues = null, $newValues = null, $notes = null)
    {
        $userId = auth()->id();

        static::create([
            'user_id' => $userId,
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'changes' => self::calculateChanges($oldValues, $newValues),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'notes' => $notes
        ]);
    }

    /**
     * Calculate what changed
     */
    private static function calculateChanges($old, $new)
    {
        if (!$old || !$new) return null;

        $changes = [];
        foreach ($new as $key => $value) {
            if (isset($old[$key]) && $old[$key] !== $value) {
                $changes[$key] = [
                    'from' => $old[$key],
                    'to' => $value
                ];
            }
        }

        return $changes ?: null;
    }

    /**
     * Scope for specific action types
     */
    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope for specific model types
     */
    public function scopeModel($query, $modelType)
    {
        return $query->where('model_type', $modelType);
    }

    /**
     * Scope for specific users
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get formatted action description
     */
    public function getFormattedActionAttribute()
    {
        $actions = [
            'created' => 'Created',
            'updated' => 'Updated',
            'deleted' => 'Deleted',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'paid' => 'Marked as Paid',
            'login' => 'Logged In',
            'logout' => 'Logged Out'
        ];

        return $actions[$this->action] ?? ucfirst($this->action);
    }

    /**
     * Get formatted model name
     */
    public function getFormattedModelAttribute()
    {
        return class_basename($this->model_type);
    }
}
