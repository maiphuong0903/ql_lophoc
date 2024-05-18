<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'class_room_id',
        'created_by',
    ];

    public function classRooms()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function userComments() : BelongsToMany
    {
        return $this->belongsToMany(
            user::class, 
            'comments', 
            'user_id', 
            'news_feed_id',
            'content',
        );
    }
}
