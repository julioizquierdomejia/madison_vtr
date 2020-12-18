<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'type',
        'avatar',
        'comments',
        'speech',
        'status_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function services() {
        return $this->belongsToMany(RequestService::class, 'video_requests_services')->withPivot('video_request_id');
    }
}
