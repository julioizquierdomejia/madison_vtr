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
        'objective_id',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function objectives() {
        return $this->hasOne(Objective::class, 'id', 'objective_id');
        //return $this->belongsToMany(Objective::class, 'video_objectives')->withPivot('video_id');
    }

    public function type() {
        return $this->hasOne(VideoType::class, 'id', 'type_id');
    }

    public function statuses() {
        return $this->belongsToMany(Status::class, 'video_statuses')->withPivot('video_id')->orderBy('video_statuses.id', 'asc');
    }
}
