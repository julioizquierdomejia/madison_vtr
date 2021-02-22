<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'type',
        'avatar',
        'comments',
        'speech',
        //'status_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function statuses() {
        return $this->belongsToMany(OrderStatus::class, 'orders_statuses')->withPivot('order_id');
    }

    public function services() {
        return $this->belongsToMany(OrderService::class, 'orders_services')->withPivot('order_id');
    }

    public function objective() {
        return $this->hasOne(Objective::class, 'id');
    }
}
