<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'time',
        'created_by',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function questions() : BelongsToMany
    {
        return $this->belongsToMany(
            Question::class, 
            'exam_question', 
            'exam_id', 
            'question_id',
        );
    }

    public function userAnswerExams() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'users_answers_exams', 
            'user_id', 
            'exam_id',
            'answer',
            'score'
        );
    }
}
