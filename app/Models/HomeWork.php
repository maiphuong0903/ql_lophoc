<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'description',
        'topic_id',
        'created_date',
        'end_date',
        'created_by',
        'homework_file',
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
