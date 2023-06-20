<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'description' , 'category_image' , 'status'
    ];




    public function posts(){
        return $this->hasMany(Post::class);
    }



    public function getCreatedAtAttribute($value){
        return date('Y/M/d:H' , strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y/M/d:H' , strtotime($value));
    }

}
