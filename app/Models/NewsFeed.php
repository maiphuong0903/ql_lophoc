<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'class_room_id',
        'created_by',
    ];

    public function classRooms() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    }
}
