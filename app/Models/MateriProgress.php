<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriProgress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','materi_detail_id','progress'];
    public function materiDetail() { return $this->belongsTo(MateriDetail::class); }
}
