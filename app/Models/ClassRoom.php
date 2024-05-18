<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'created_by',
    ];

    public function topics() : HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function newsFeeds() : HasMany
    {
        return $this->hasMany(NewsFeed::class);
    }

    public function created_by() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function userClassRoom() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'user_class_room', 
            'user_id', 
            'class_room_id',
        );
    }

}

