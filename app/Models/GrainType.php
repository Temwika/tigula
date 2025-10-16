<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrainType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'price_per_kg',
        'is_active',
        'seasonal_price_factor',
        'quality_grade',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_per_kg' => 'decimal:2',
        'seasonal_price_factor' => 'decimal:3',
    ];

    /**
     * Get transactions for this grain type
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Scope to get active grain types
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get current effective price (with seasonal factors)
     */
    public function getCurrentPriceAttribute()
    {
        return $this->price_per_kg * ($this->seasonal_price_factor ?? 1.0);
    }

    /**
     * Get total transactions value for this grain type
     */
    public function getTotalTransactionsValueAttribute()
    {
        return $this->transactions()->where('status', 'completed')->sum('total_amount');
    }

    /**
     * Get total weight transacted for this grain type
     */
    public function getTotalWeightTransactedAttribute()
    {
        return $this->transactions()->where('status', 'completed')->sum('weight_kg');
    }
}