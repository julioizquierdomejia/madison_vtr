<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RitualStatus extends Model
{
    use HasFactory;

    protected $table = 'ritual_status';

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
