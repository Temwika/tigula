<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'farmer_id',
        'grain_type_id',
        'depot_id',
        'weight_kg',
        'price_per_kg',
        'total_amount',
        'status',
        'quality_grade',
        'moisture_content',
        'recorded_by',
        'notes',
        'transaction_date',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'moisture_content' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    /**
     * Transaction statuses
     */
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Boot the model and generate transaction number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_number)) {
                $transaction->transaction_number = self::generateTransactionNumber();
            }
        });

        static::saving(function ($transaction) {
            // Auto-calculate total amount
            if ($transaction->weight_kg && $transaction->price_per_kg) {
                $transaction->total_amount = $transaction->weight_kg * $transaction->price_per_kg;
            }
        });
    }

    /**
     * Generate unique transaction number
     */
    public static function generateTransactionNumber(): string
    {
        do {
            $number = 'TXN' . date('Ymd') . strtoupper(Str::random(6));
        } while (self::where('transaction_number', $number)->exists());

        return $number;
    }

    /**
     * Get the farmer that owns the transaction
     */
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    /**
     * Get the grain type for this transaction
     */
    public function grainType()
    {
        return $this->belongsTo(GrainType::class);
    }

    /**
     * Get the depot for this transaction
     */
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    /**
     * Get the user who recorded this transaction
     */
    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Get payments for this transaction
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope to get completed transactions
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope to get pending transactions
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }
}