<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'post_id','comment'];

    public function posts()
    {
        return $this->belongsTo(post::class,'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }


}
