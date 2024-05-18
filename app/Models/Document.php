<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'document_url',
        'topic_id',
        'created_by',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }
}
