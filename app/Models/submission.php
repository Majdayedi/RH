<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Submission extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'form_id',
        'user_id',
        'data',           // Added to match database
        'status',
        'reviewed_by',    // Added to match database
    ];

    protected $casts = [
        'data' => 'array', // Cast the longtext data field to array if it stores JSON
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}