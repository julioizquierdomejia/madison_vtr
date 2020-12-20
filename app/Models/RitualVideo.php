<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RitualVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'ritual_id',
        'video_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
