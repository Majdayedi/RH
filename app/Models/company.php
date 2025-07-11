<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'legal_name',
        'trade_name',
        'registration_number',
        'tax_id',
        'incorporation_date',
        'legal_structure',
        'jurisdiction',
        'industry',
        'is_active',
        'headquarters_address',
        'country',
        'phone',
        'email',
        'website',
        'certificate_of_incorporation',
        'tax_registration_certificate',
        'logo'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subscription_expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the users for the company.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the forms for the company.
     */
    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
