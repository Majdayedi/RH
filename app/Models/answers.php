<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Answer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'submission_id',
        'question_id',
        'answer_text',
        'answer_value'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
