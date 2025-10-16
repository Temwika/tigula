<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
        'depot_id',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * User roles
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_AGGREGATOR = 'aggregator';
    const ROLE_FARMER = 'farmer';

    /**
     * Get all available roles
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_AGGREGATOR => 'Aggregator',
            self::ROLE_FARMER => 'Farmer',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    /**
     * Check if user is aggregator
     */
    public function isAggregator(): bool
    {
        return $this->hasRole(self::ROLE_AGGREGATOR);
    }

    /**
     * Check if user is farmer
     */
    public function isFarmer(): bool
    {
        return $this->hasRole(self::ROLE_FARMER);
    }

    /**
     * Get the depot that the user belongs to
     */
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    /**
     * Get the farmer profile if user is a farmer
     */
    public function farmer()
    {
        return $this->hasOne(Farmer::class);
    }

    /**
     * Scope to get users by role
     */
    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to get active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}