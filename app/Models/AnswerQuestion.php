<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerQuestion extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'question_id',
        'answer_content',
        'is_correct',
        'answer_index'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
