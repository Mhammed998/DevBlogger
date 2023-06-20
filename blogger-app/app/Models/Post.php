<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $fillable = [
        'title' , 'content' ,'status' , 'post_image' , 'user_id' , 'category_id'
    ];



    public function getShortContentAttribute()
    {
        $taglessDescription = strip_tags($this->content);
        return Str::limit($taglessDescription, 300, '..');
    }

    public function getShortTitleAttribute()
    {
        $title = $this->title;
        return Str::limit($title, 100, '..');
    }


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function getCreatedAtAttribute($value){
        return date('M d , Y  H:i' , strtotime($value));
    }

//    MAY 21, 2018 AT 13:16

    public function getUpdatedAtAttribute($value){
        return date('M d , Y  H:i' , strtotime($value));
    }

    public function allUsers(){
        return $this->belongsToMany(User::class , 'favorite_post');
    }

}
