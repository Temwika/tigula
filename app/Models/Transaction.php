<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'grain_type_id',
        'depot_id',
        'weight_kg',
        'unit_price',
        'total_amount',
        'status',
        'notes',
        'created_by',
        'approved_by',
        'approved_at',
        'sms_sent_at',
        'transaction_number'
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'sms_sent_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($transaction) {
            $transaction->transaction_number = 'TXN-' . date('Y') . '-' . str_pad(static::count() + 1, 6, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Get the farmer for this transaction
     */
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    /**
     * Get the grain type
     */
    public function grainType()
    {
        return $this->belongsTo(GrainType::class);
    }

    /**
     * Get the depot
     */
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    /**
     * Get the user who created this transaction
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who approved this transaction
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get payments for this transaction
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope to get pending transactions
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get approved transactions
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get paid transactions
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Check if transaction can be approved
     */
    public function canBeApproved()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment can be initiated
     */
    public function canInitiatePayment()
    {
        return $this->status === 'approved';
    }

    /**
     * Approve the transaction
     */
    public function approve($approvedBy)
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $approvedBy,
            'approved_at' => now(),
        ]);
    }

    /**
     * Mark as paid
     */
    public function markAsPaid()
    {
        $this->update(['status' => 'paid']);
    }
}