<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'code',
        'image',
        'created_by',
    ];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\ClassRoomFilter::class);
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function newsFeeds(): HasMany
    {
        return $this->hasMany(NewsFeed::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_class_rooms',
            'user_id',
            'class_room_id',
        );
    }
}
