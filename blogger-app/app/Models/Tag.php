<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable=[
        'tag_name' ,'status'
    ];





    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getCreatedAtAttribute($value){
        return date('Y/M/d' , strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y/M/d' , strtotime($value));
    }

}
