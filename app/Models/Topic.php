<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_room_id',
        'created_by',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function documents() : HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function home_works() : HasMany
    {
        return $this->hasMany(HomeWork::class);
    }

    public function questions() : HasMany
    {
        return $this->hasMany(Question::class);
    }
}
