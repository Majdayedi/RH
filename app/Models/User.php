<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'matricule',
        'email',
        'password',
        'role',
        'first_name',
        'company_id',
        'department',
        'hr_role',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token', // Hidden but still auto-managed
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',  // Auto-hashing
        'is_active' => 'boolean',
        'last_login_at' => 'datetime'
    ];

    /**
     * Disable auto-incrementing IDs since we're using UUIDs
     */
    public $incrementing = false;

    /**
     * Set the key type to string for UUIDs
     */
    protected $keyType = 'string';

    /**
     * Automatically manage timestamps
     */
    public $timestamps = true; // Default, can be omitted

    /**
     * Relationships
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}