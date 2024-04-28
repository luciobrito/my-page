<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;
    protected $table = 'userimage';
    protected $fillable = ['name', 'user_id'];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
