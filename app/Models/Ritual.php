<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ritual extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ritual_objective_id',
        'ritual_status_id',
        'published',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
