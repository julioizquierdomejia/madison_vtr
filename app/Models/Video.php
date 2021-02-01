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
        'type_id',
        'user_id',
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

    public function objectives() {
        //return $this->hasOne(VideoObjective::class);
        return $this->belongsToMany(Objective::class, 'video_objectives')->withPivot('video_id');
    }

    public function statuses() {
        return $this->belongsToMany(Status::class, 'video_statuses')->withPivot('video_id');
    }
}
