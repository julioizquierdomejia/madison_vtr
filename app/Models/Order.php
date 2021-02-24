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

    /*public function statuses() {
        return $this->belongsToMany(OrderStatus::class, 'orders_statuses')->withPivot('order_id');
    }*/

    public function services() {
        return $this->belongsToMany(Service::class, 'order_services')->withPivot('order_id');
    }

    public function objective() {
        return $this->hasOne(Objective::class, 'id');
    }

    public function video() {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /*public function info(){
        return $this->hasOne(UserInformation::class, 'user_id', 'id');
    }*/
}
