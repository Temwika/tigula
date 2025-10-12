<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin (agro-dealer)
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is agro-dealer (same as admin)
     */
    public function isAgroDealer(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is aggregator (field buyer)
     */
    public function isAggregator(): bool
    {
        return $this->role === 'aggregator';
    }

    /**
     * Check if user is field buyer (same as aggregator)
     */
    public function isFieldBuyer(): bool
    {
        return $this->role === 'aggregator';
    }

    /**
     * Check if user is farmer
     */
    public function isFarmer(): bool
    {
        return $this->role === 'farmer';
    }

    /**
     * Get transactions created by this user (for aggregators)
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'created_by');
    }

    /**
     * Get farmer profile if user is a farmer
     */
    public function farmerProfile()
    {
        return $this->hasOne(Farmer::class, 'user_id');
    }

    /**
     * Get float allocations sent by this agro-dealer
     */
    public function sentFloatAllocations()
    {
        return $this->hasMany(FloatAllocation::class, 'agro_dealer_id');
    }

    /**
     * Get float allocations received by this field buyer
     */
    public function receivedFloatAllocations()
    {
        return $this->hasMany(FloatAllocation::class, 'field_buyer_id');
    }

    /**
     * Get total available float balance for field buyer
     */
    public function getTotalFloatBalanceAttribute()
    {
        return $this->receivedFloatAllocations()
            ->where('status', 'active')
            ->sum('remaining_amount');
    }
}
