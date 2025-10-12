<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrc_number',
        'full_name',
        'phone_number',
        'village',
        'district',
        'province',
        'user_id',
        'is_verified',
        'verification_date',
        'notes'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verification_date' => 'datetime',
    ];

    /**
     * Get the user associated with this farmer
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all transactions for this farmer
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get payments for this farmer
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Transaction::class);
    }

    /**
     * Scope to get verified farmers
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope to search farmers by NRC or name
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nrc_number', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
    }

    /**
     * Get total grain sold by this farmer
     */
    public function getTotalGrainSoldAttribute()
    {
        return $this->transactions()->where('status', 'paid')->sum('weight_kg');
    }

    /**
     * Get total earnings for this farmer
     */
    public function getTotalEarningsAttribute()
    {
        return $this->transactions()->where('status', 'paid')->sum('total_amount');
    }
}