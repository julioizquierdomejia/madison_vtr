<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoStatus extends Model
{
    use HasFactory;

    //protected $table = 'video_status_status';

    protected $fillable = [
        'video_id',
        'status_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
