<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'topic_id',
        'created_date',
        'end_date',
        'created_by',
        'homework_file',
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
