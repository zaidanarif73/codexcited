<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Materi extends Model
{
    use HasFactory, HasTrixRichText;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover',
        'type',
        'difficulty',
    ];
}
