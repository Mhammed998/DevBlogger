<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=[
        'comment' , 'user_id' , 'post_id' , 'status' , 'parent_id'
    ];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value){
        return date('Y/M/d H:i' , strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y/M/d H:i' , strtotime($value));
    }

}
