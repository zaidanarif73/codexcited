<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreLog extends Model
{
    protected $fillable = [
        'user_id',
        'source',
        'score',
        'total_score',
    ];
}
