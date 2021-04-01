<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\post;
use Illuminate\Database\Schema\PostgresSchemaState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\friend;

class PostController extends Controller
{

    public function index(post $post )
    {
        $user_id = Auth::user()->id;
 /*       $posts = post::with(User::class)->where('id')->get();*/
//        $posts = Post::whereIn('user_id', auth()->user()->friends()->pluck('id'))->get();
//        $posts = DB::table('users')->join('friends','user_requested','==',$user_id)->
//        where('status',1)
//        ->join('posts', 'posts.user_id', '=', 'user.id')
//
//        ->get();
//        $posts = User::find(1)->friends()->with('posts')->get();
//        $posts = post::with('users')->with('friends')->
//            where('status',1);
        $friends = Auth::user()->getFriends();
        $friend_ids = [];
        $friend_ids[] = Auth::user()->id;
        foreach ($friends as $friend){
            $friend_ids[] = $friend->id;
        }
        $posts = post::wherein('user_id', $friend_ids)->orderByDesc('updated_at')->get();
//        $posts = json_decode(json_encode($posts), true);
//        dd($friends, $posts);//tests
//        $posts = $post->all();

        return view('/home', compact('posts'));
    }


    public function create()
    {
        return view('posts/create');
    }


    public function store(Request $request,post $post)
    {

        $validatedAttributes = request()->validate([
            'post' => ['required', 'min:2', 'max:255', 'string'],
            'image' => ['image'],
        ]);
        $validatedAttributes['user_id'] = Auth()->id();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('image', $imageName);
            $validatedAttributes['image'] = $path;
            post::create($validatedAttributes);//the object is identical to what i need so i use it to have less code.
        }
        return redirect('/home');
    }


    public function show(post $post)
    {
        //
    }


    public function edit(post $post )
    {
//        $user_id = Auth::user()->id;

//        $friends2 = post::with( 'user.friends')->get();
//        $friends = friend::where("user_requested", "=", $user_id)
//            ->orWhere("acceptFriend", "=", $user_id)->where("status", "=", 1)
//            ->with([ 'posts' => function ($query) use ($user_id) {
//                $query->where("$user_id", "=", "user_id");
//            }])->get();

        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, post $post)
    {
        $this->authorize('update', $post);
        $validatedAttributes = request()->validate([
            'post' => [ 'min:2', 'max:100', 'string'],
            'image' => ['image'],
        ]);
        $validatedAttributes['user_id'] = Auth()->id();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('image', $imageName);
            $validatedAttributes['image'] = $path;
            $post->update($validatedAttributes);
        }
        $post->update($validatedAttributes);
        return redirect('/home');
    }


    public function destroy(post $post)
    {
        $this->authorize('delete', $post);
            $post->delete();
        return redirect('/home')->with('success','Post deleted');;
    }
}
