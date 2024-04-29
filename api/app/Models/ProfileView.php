<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{
    use HasFactory;
    protected $table = 'profileview';
    protected $fillable = ['user_ip','viewer_id','user_id'];
    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
