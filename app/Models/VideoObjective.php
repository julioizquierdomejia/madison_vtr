<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'objective_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
