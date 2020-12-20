<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RitualObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'ritual_id',
        'objective_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
