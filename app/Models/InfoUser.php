<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'empresa',
        'cargo',
        'photo',
        'parent_id',
    ];


    public function user(){
        return $this->oneToOne(User::class);
    }
}
