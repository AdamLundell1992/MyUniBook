<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function index()
    {
//This function will get a list of friends that the user can message with because the user should only be avaiable to message friends and not all users.
        $friends = Auth::user()->getFriends();
        $friend_ids = [];
        foreach ($friends as $friend) {
            $friend_ids[] = $friend->id;
        }
        $users = User::wherein('id', $friend_ids)->orderByDesc('updated_at')->get();
        return view('messages.index', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]); //updates unread message to read in the database

        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id); // check if the other user have send a message to the logged in user
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);// check if the logged in user send a message to the other user .
        })->get();
// Both ways need to be checked because 1 message data line in the data base will be from to and to from so to make it from
// unread to read this is necessary.
        return view('messages.show', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        {
            $from_User = Auth::id();
            $to_User = $request->receiver_id;
            $message = $request->message;

            $data = new Message();
            $data->from = $from_User;
            $data->to = $to_User;
            $data->message = $message;
            $data->is_read = 0;
            $data->save();

            // pusher
            $options = array(
                'cluster' => 'eu',
                'useTLS' => false
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $data = ['from' => $from_User, 'to' => $to_User]; // This is so the users can click enter instead of click on a send button
            $pusher->trigger('my-channel', 'my-event', $data);
        }
    }

}
