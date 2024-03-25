<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory;
    protected $fillable = ['user_ip', 'post_id', 'user_id'];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
