<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'content',
        'answer',
        'topic_id',
        'created_by',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }

    public function exams() : BelongsToMany
    {
        return $this->belongsToMany(
            Exam::class, 
            'exams_questions', 
            'question_id', 
            'exam_id',
        );
    }

    public function answers()
    {
        return $this->hasMany(AnswerQuestion::class);
    }
}
