<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'created_by',
        'type',
        'class_room_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class. 'created_by');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'user_notifications', 
            'notification_id',
            'user_id',   
        );
    }
}
