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
        'depot_id',
        'is_verified',
        'date_of_birth',
        'gender',
        'farming_experience_years',
        'land_size_hectares',
        'bank_account_number',
        'bank_name',
        'mobile_money_number',
        'verification_date',
        'notes',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'date_of_birth' => 'date',
        'verification_date' => 'datetime',
        'farming_experience_years' => 'integer',
        'land_size_hectares' => 'decimal:2',
    ];

    /**
     * Get the user that owns the farmer
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the depot that the farmer belongs to
     */
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    /**
     * Get transactions for this farmer
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Scope to get verified farmers
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Get farmer's full address
     */
    public function getFullAddressAttribute()
    {
        return "{$this->village}, {$this->district}, {$this->province}";
    }
}