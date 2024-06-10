<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use EloquentFilter\Filterable;

class Exam extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'time',
        'created_by',
        'expiration_date',
        'class_room_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions() : BelongsToMany
    {
        return $this->belongsToMany(
            Question::class, 
            'exams_questions', 
            'exam_id', 
            'question_id',
        );
    }

    public function userAnswerExams() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'users_answers_exams', 
            'exam_id', 
            'user_id',
        )->withPivot('answer', 'score', 'created_at', 'updated_at', 'question_id');
    }

    // kiểm tra xem học sinh đó đã nộp bài kiểm tra hay chưa
    public function hasSubmittedByUser($userId)
    {
        return $this->userAnswerExams()->where('user_id', $userId)->exists();
    }
}
