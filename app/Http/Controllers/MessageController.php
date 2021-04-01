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
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {

        $friends = Auth::user()->getFriends();
        $friend_ids = [];
        foreach ($friends as $friend){
            $friend_ids[] = $friend->id;
        }
        $users = User::wherein('id', $friend_ids)->orderByDesc('updated_at')->get();

        return view('messages.index',['users' => $users]);
    }

    public function getMessage($user_id){
        $my_id = Auth::id();
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

       return view('messages.show',['messages'=>$messages]);
    }

    public function sendMessage(Request $request){

        {
            $from = Auth::id();
            $to = $request->receiver_id;
            $message = $request->message;

            $data = new Message();
            $data->from = $from;
            $data->to = $to;
            $data->message = $message;
            $data->is_read = 0; // message will be unread when sending message
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

            $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $data);
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show(Message $message)
    {
        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.image, users.email");

        return view('messages/index',['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
