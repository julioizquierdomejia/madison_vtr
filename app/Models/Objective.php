<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
