<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    //protected $table = 'user_plans';

    protected $fillable = [
        'user_id',
        'plan_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
