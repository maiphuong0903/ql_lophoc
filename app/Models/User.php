<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'gender',
        'birthday',
        'avatar',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function created_by_class_room() : HasMany
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function classRooms() : BelongsToMany
    {
        return $this->belongsToMany(
            ClassRoom::class, 
            'user_class_room', 
            'user_id', 
            'class_room_id',
        );
    }

    public function created_by_comment() : HasMany
    {
        return $this->hasMany(NewsFeed::class, 'id');
    }

    public function newsFeedsComments() : BelongsToMany
    {
        return $this->belongsToMany(
            NewsFeed::class, 
            'comments', 
            'user_id', 
            'news_feed_id',
            'content',
        );
    }
    
    public function created_by_topic() : HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function created_by_notification() : HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function notifications() : BelongsToMany
    {
        return $this->belongsToMany(
            Notification::class, 
            'user_notification', 
            'user_id', 
            'notification_id',
        );
    }

    public function created_by_homework() : HasMany
    {
        return $this->hasMany(HomeWork::class);
    }

    public function answerHomeworks() : BelongsToMany
    {
        return $this->belongsToMany(
            HomeWork::class, 
            'users_answers_home_works', 
            'user_id', 
            'homework_id',
            'answer',
            'score',
            'homework_file',
        );
    }

    public function created_by_question() : HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function created_by_exam() : HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function answerExams() : BelongsToMany
    {
        return $this->belongsToMany(
            Exam::class, 
            'users_answers_exams', 
            'user_id', 
            'exam_id',
            'answer',
            'score'
        );
    }
    
    public function created_by_document() : HasMany
    {
        return $this->hasMany(Document::class);
    }
}
