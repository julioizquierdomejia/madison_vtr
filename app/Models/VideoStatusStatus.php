<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoStatusStatus extends Model
{
    use HasFactory;

    protected $table = 'video_status_status';

    protected $fillable = [
        'id_video',
        'id_status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
