<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'orders_statuses';

    protected $fillable = [
        'status_id',
        'order_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}