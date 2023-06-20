<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    // php artisan db:seed --class=PermissionTableSeeder
    // php artisan db:seed --class=CreateAdminUserSeeder
    // php artisan db:seed --class=TagSeeder


    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_names',
        'status',
        'avatar',
        'about'
    ];






    //Relationships

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favPosts()
    {
        return $this->belongsToMany(Post::class,'favorite_post');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



    public function getCreatedAtAttribute($value){
        return date('M d , Y  H:i' , strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('M d , Y  H:i' , strtotime($value));
    }



    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'roles_names' => 'array'
    ];
}
