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
        'created_by'
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function userNotifications() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'user_notification', 
            'user_id', 
            'notification_id',
        );
    }
}
