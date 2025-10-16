<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'address',
        'phone',
        'manager_name',
        'is_active',
        'capacity_tonnes',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'capacity_tonnes' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get users associated with this depot
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get transactions for this depot
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get farmers associated with this depot
     */
    public function farmers()
    {
        return $this->hasMany(Farmer::class);
    }

    /**
     * Scope to get active depots
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get total transactions value for this depot
     */
    public function getTotalTransactionsValueAttribute()
    {
        return $this->transactions()->where('status', 'completed')->sum('total_amount');
    }

    /**
     * Get total grain weight handled by this depot
     */
    public function getTotalGrainWeightAttribute()
    {
        return $this->transactions()->where('status', 'completed')->sum('weight_kg');
    }
}