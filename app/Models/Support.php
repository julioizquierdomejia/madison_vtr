<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_type',
        'user_id',
        'message',
        'answered',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id');
    }

    public function type() {
        return $this->hasOne(SupportType::class, 'id');
    }
}
