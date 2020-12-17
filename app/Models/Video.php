<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file',
        'description',
        'video_type_id',
        'video_status_id',
        'format',
        //'quality',
        //'audio',
        'part',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function objective(){
        return $this->hasOne(VideoObjective::class);
    }
}
