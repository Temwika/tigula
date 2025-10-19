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
        'mobile_number',
        'mobile_money_reference',
        'status',
        'processed_by',
        'processed_at',
        'payment_date',
        'failure_reason',
        'notes',
        'gateway_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
        'payment_date' => 'date',
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
    const METHOD_AIRTEL_MONEY = 'airtel_money';
    const METHOD_MTN_MONEY = 'mtn_money';
    const METHOD_ZAMTEL_MONEY = 'zamtel_money';
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
            self::METHOD_AIRTEL_MONEY => 'Airtel Money',
            self::METHOD_MTN_MONEY => 'MTN Money',
            self::METHOD_ZAMTEL_MONEY => 'Zamtel Money',
            self::METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::METHOD_CASH => 'Cash',
        ];
    }
}