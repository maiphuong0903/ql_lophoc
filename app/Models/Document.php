<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'description',
        'document_url',
        'topic_id',
        'created_by',
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
}
