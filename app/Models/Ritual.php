<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ritual extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_id',
        'type_id',
        'objective_id',
        'user_id',
        'file',
        'enabled',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at'
    ];
}
