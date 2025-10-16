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

    // Relationships with deleted models removed

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

    // Getter methods for deleted models removed
}