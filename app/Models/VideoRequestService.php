<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoRequestService extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_request_id',
        'request_service_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
