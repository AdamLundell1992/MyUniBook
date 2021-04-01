<?php

namespace App\Models;
use App\Traits\Friendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasFactory, Notifiable,Friendable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',
        'email',
        'password',
        'image',
        'user_info',
        'UniCourse',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->hasMany(post::class,'user_id');
    }
    public function getFriends(){
        $user_id = Auth::user()->id;
        $friend1 = DB::table('friends')
            ->leftJoin('users', 'users.id','friends.acceptFriend')
            ->where('status',1)
            ->where('user_requested',$user_id)
            ->get();

        $friend2 = DB::table('friends')
            ->leftJoin('users', 'users.id','friends.user_requested')
            ->where('status',1)
            ->where('acceptFriend',$user_id)
            ->get();

        $friends = array_merge($friend1->toArray(),$friend2->toArray());
        return $friends;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function friends()
    {
    return $this->hasMany(friend::class);
    }

}
