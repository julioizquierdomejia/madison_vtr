<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_information';
    
    protected $fillable = [
        'user_id',
        'empresa',
        'cargo',
        'photo',
        'parent_id',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
}
