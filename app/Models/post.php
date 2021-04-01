<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\friend;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['post','user_id','image'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function friends()
    {
        return $this->belongsTo(friend::class );
    }

}
