<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RitualType extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
