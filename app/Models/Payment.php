<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'payment_reference',
        'amount',
        'payment_method',
        'mobile_money_number',
        'status',
        'processed_by',
        'processed_at',
        'notes',
        'gateway_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
        'gateway_response' => 'array',
    ];

    /**
     * Payment statuses
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Payment methods
     */
    const METHOD_MOBILE_MONEY = 'mobile_money';
    const METHOD_BANK_TRANSFER = 'bank_transfer';
    const METHOD_CASH = 'cash';

    /**
     * Get the transaction that owns the payment
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the user who processed this payment
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Scope to get completed payments
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope to get pending payments
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
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_FAILED => 'Failed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * Get all available payment methods
     */
    public static function getPaymentMethods(): array
    {
        return [
            self::METHOD_MOBILE_MONEY => 'Mobile Money',
            self::METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::METHOD_CASH => 'Cash',
        ];
    }
}