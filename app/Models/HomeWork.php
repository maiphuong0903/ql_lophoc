<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HomeWork extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'description',
        'topic_id',
        'created_date',
        'end_date',
        'created_by',
        'homework_file',
        'class_room_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }

    public function assignedUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_answers_home_works',
            'home_work_id',
            'user_id',   
        )->withPivot('answer', 'comment', 'score', 'created_at', 'updated_at');
    }

    public function isSubmittedByStudent($studentId)
    {
        return $this->assignedUsers()->wherePivot('user_id', $studentId)->exists();
    }

    public function isGradedByTeacher($studentId)
    {
        return $this->assignedUsers()->where('user_id', $studentId)->whereNotNull('users_answers_home_works.score')->exists();
    }

    public function classRooms()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
