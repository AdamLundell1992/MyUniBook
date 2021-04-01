<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class friend extends Model
{
    use HasFactory;


protected $fillable =  ['user_requested','status','acceptFriend'];
    public function user()
    {
        return $this->hasMany(User::class , 'user_id');}

    public function posts()
    {
        return $this->hasMany(post::class);}

}
