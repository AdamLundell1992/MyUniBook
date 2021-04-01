<?php

namespace App\Traits;

use App\Models\friend;
use Illuminate\Support\Facades\Auth;

trait Friendable
{

    public function addFriend($acceptFriend_id)
    {
        if ($this->id === $acceptFriend_id ) {
            return 0;
        }
        if($this->is_friend_with($acceptFriend_id) === 1){
            return "Already friends";
        }
//        if($this->has_pending_friend_request_to($acceptFriend_id === 1)){
//            return "Already sent friend Request";
//        }
//        if($this->has_pending_friend_request_from($acceptFriend_id === 1)){
//            return $this->accept_friend($acceptFriend_id);
//        }
        $friendship = friend::create([
            'user_requested' => $this->id,
            'acceptFriend' => $acceptFriend_id
        ]);
        if ($friendship) {
            return 1;
        }
        return 0;
    }
    public function acceptFriend($user_requested){
        if($this->has_pending_friend_request_from($user_requested) === 0){
            return 0;
        }
        $friendship = friend::where('user_requested',$user_requested)
            ->where('$acceptFriend',$this->id)
            ->first();
        if ($friendship){
            $friendship->update([
               'status'=>1
            ]);
            return 1;
        }
        return 0;
    }

    public function friends()
    {
        $friends = array();
        $f1 = friend::where('status', 1)->
        where('user_requested', $this->id)->get();
        foreach ($f1 as $friendship):
            array_push($friends, User::find($friendship->acceptFriend));
        endforeach;
        $friends2 = array();
        $f2 = friend::where('status', 1)->
        where('acceptFriend', $this->id)->get();
        foreach ($f2 as $friendship):
            array_push($friends2, User::find($friendship->user_requested));
        endforeach;
        return array_merge($friends, $friends2);
    }

    public function pendingFriendRequest()
    {
        $users = array();
        $friendships = friend::where('status', 0)->
        where('acceptFriend', $this->id)->get();
        foreach ($friendships as $friendship):
            array_push($users, User::find($friendship->user_requested));
        endforeach;
    }

    public function friends_ids()
    {
        Return collect($this->friends())->pluck('id')->toArray();
    }

    public function is_friend_with($id)
    {
        if (in_array($id, $this->friends_ids())) {
            return 1;
        } else {
            return 0;
        }
    }

    public function pending_friend_requests_ids()
    {
        return collect($this->pendingFriendRequest())->pluck('id')->toArray();
    }

    public function pending_friend_request_sent()
    {
        $users = array();
        $friendships = friend::where('status', 0)->
        where('user_requested', $this->id)->get();
        foreach ($friendships as $friendship):
            array_push($users, User::find($friendship->acceptFriend));
        endforeach;
        return $users;
    }

    public function pending_friend_request_sent_ids()
    {
        return collect($this->pending_friend_request_sent())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id)#
    {
        if (in_array($user_id, $this->pending_friend_requests_ids())) {
            return 1;
        } else {
            return 0;

        }
    }
    public function has_pending_friend_request_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_ids())) {
            return 1;
        } else {
            return 0;

        }
    }

}
