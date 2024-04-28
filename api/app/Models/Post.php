<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{    
    use HasFactory;
    protected $fillable = [
        'body','title', 'user_id'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function PostView()
    {
        return $this->hasMany(PostView::class, 'post_id');
    }
    public function PostImage()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }
}
