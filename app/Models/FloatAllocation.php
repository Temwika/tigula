<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloatAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'allocation_number',
        'agro_dealer_id',
        'field_buyer_id',
        'allocated_amount',
        'used_amount',
        'remaining_amount',
        'status',
        'notes',
        'allocated_at',
        'expires_at',
        'recalled_at'
    ];

    protected $casts = [
        'allocated_amount' => 'decimal:2',
        'used_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'allocated_at' => 'datetime',
        'expires_at' => 'datetime',
        'recalled_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($allocation) {
            $allocation->allocation_number = 'FLOAT-' . date('Y') . '-' . str_pad(static::count() + 1, 6, '0', STR_PAD_LEFT);
            $allocation->allocated_at = now();
            $allocation->remaining_amount = $allocation->allocated_amount;
        });
    }

    /**
     * Get the agro-dealer who allocated this float
     */
    public function agroDealer()
    {
        return $this->belongsTo(User::class, 'agro_dealer_id');
    }

    /**
     * Get the field buyer who received this float
     */
    public function fieldBuyer()
    {
        return $this->belongsTo(User::class, 'field_buyer_id');
    }

    /**
     * Check if allocation has sufficient balance
     */
    public function hasSufficientBalance($amount)
    {
        return $this->remaining_amount >= $amount && $this->status === 'active';
    }

    /**
     * Use some of the allocated amount
     */
    public function useAmount($amount)
    {
        if (!$this->hasSufficientBalance($amount)) {
            return false;
        }

        $this->used_amount += $amount;
        $this->remaining_amount -= $amount;

        if ($this->remaining_amount <= 0) {
            $this->status = 'depleted';
        }

        $this->save();
        return true;
    }

    /**
     * Get formatted allocated amount
     */
    public function getFormattedAllocatedAmountAttribute()
    {
        return 'K ' . number_format($this->allocated_amount, 2);
    }

    /**
     * Get formatted remaining amount
     */
    public function getFormattedRemainingAmountAttribute()
    {
        return 'K ' . number_format($this->remaining_amount, 2);
    }
}