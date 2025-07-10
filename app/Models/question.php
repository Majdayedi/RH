<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'form_id',
        'type',
        'title',
        'description',
        'is_required',
        'order',
        'options',
    ];

    protected $casts = [
        'id' => 'string',
        'form_id' => 'string',
        'is_required' => 'boolean',
        'order' => 'integer',
        'options' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
