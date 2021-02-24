<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_services';

    protected $fillable = [
        'service_id',
        'order_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
