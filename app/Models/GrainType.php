<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrainType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'current_price',
        'unit',
        'description',
        'is_active'
    ];

    protected $casts = [
        'current_price' => 'decimal:2',
        'is_active' => 'boolean',
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
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'K ' . number_format($this->current_price, 2);
    }
}