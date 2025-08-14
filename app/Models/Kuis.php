<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'materi_id',
        'question',
        'options',
        'correct',
        'explanation',
    ];

    protected $casts = [
        'options' => 'array', // untuk otomatis decode json ke array
        'correct' => 'integer',
    ];
}
