<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Traits\TrixRender;

class MateriDetail extends Model
{
    use HasFactory, HasTrixRichText, TrixRender;

    protected $fillable = [
        'materi_id',
        'title',
        'description',
    ];
}
