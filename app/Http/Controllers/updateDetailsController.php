<?php

namespace App\Http\Controllers;

use App\Models\friend;
use Faker\Provider\ro_RO\Text;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class updateDetailsController extends Controller
{
    public function edit(User $user)
    {

        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedAttributes = request()->validate([
            'name' => ['string', 'max:255'],
            'user_info' => ['max:255'],
            'UniCourse' => ['max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'university_year' => ['max:255'],
            'date_of_birth' => ['date', 'before:' . Carbon::now()->subYears(18)],
            'gender' => ['max:255'],
            'password' => ['min:8', 'confirmed'],
            'image' => ['image'],
        ]);

        if ($request->password )
        {
            $newpassword = bcrypt(request('password'));
            $validatedAttributes['password'] = $newpassword;
            $user->update($validatedAttributes);
        }



        if (isset($request->date_of_birth)) {
            $dob = Carbon::createFromFormat('m/d/Y', $request->date_of_birth)->format('Y-m-d');
            $validatedAttributes['date_of_birth'] = $dob;
            $user->update($validatedAttributes);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('image', $imageName);
            $validatedAttributes['image'] = $path;
            $user->update($validatedAttributes);
        }

        $user->update($validatedAttributes);
        return redirect()->back()->with('success', true);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);
        $user_id = Auth::user()->id;

        $search_text = $_GET['query'];
        $users = User::where('name', 'LIKE', '%' . $search_text . '%')->
        orwhere('UniCourse', 'LIKE', '%' . $search_text . '%')
            ->orwhere('university_year', 'LIKE', '%' . $search_text . '%')
            ->orwhere('date_of_birth', 'LIKE', '%' . $search_text . '%')
            ->orwhere('gender', 'LIKE', '%' . $search_text . '%')->paginate(30);
        if (empty('query')) {
            return view('home')->withInput()->withErrors(['msg' => 'try again']);
        }
        return view('auth.search', compact('users'));
    }

    public function addfriend($id)
    {
        $user_id = Auth::user()->id;

        $checkIfFriend1 = friend::where('user_requested', $user_id)->
        where('acceptFriend', $id)->
        where('status', 1)->first();
        $checkIfFriend2 = friend::where('acceptFriend', $user_id)->
        where('user_requested', $id)->
        where('status', 1)->first();
        if ($checkIfFriend1 || $checkIfFriend2) {
            return back()->with('alreadyfriends', 'You and this user are already friends');
        }

        Auth::user()->addFriend($id);
        if ($id == Auth::id()) {
            return back()->with('notAdd', 'Sorry,cannot Add yourself as a friend');
        }
        return back()->with('addf', 'Friend request sent');


    }

    public function deleteFriend($id)
    {
        $delete_friend = DB::table('friends')->where('acceptFriend', $id)->delete();
        return back()->with('delef', 'You have cancelled friend request');
    }

    public function showFriendRequest()
    {
        $user_id = Auth::user()->id;
        $users = DB::table('friends')->rightJoin('users', 'users.id', '=',
            'friends.user_requested')->where('friends.acceptFriend', '=', $user_id)->
        where('status', '=', 0)->get();

        return view('auth.friendRequest', compact('users'));

    }

    public function confirmRequest($id)
    {
        $user_id = Auth::user()->id;
        $checkRequest = friend::where('user_requested', $id)
            ->where('acceptFriend', $user_id)
            ->first();
        if ($checkRequest) {

            $updateFriendship = DB::table('friends')
                ->where('acceptFriend', $user_id)
                ->where('user_requested', $id)
                ->update(['status' => 1]);

        }
        return back();
    }

    public function deleteRequest($id)
    {
        $delete = DB::table('friends')->where('user_requested',
            $id)->delete();
        return back();
    }

    public function checkProfile($id)
    {
        $users = User::where('id', $id)->get();
        return view('profile.userprofile', compact('users'));
    }

    public function friendsList()
    {
        $friends = Auth::user()->getFriends();
        return view('auth.friendlist', compact('friends'));
    }

    public function unFriend($id)
    {
        $YourUser = Auth::user()->id;
        DB::table('friends')
            ->where('user_requested', $YourUser)
            ->where('acceptFriend', $id)
            ->delete();
        DB::table('friends')
            ->where('acceptFriend', $YourUser)
            ->where('user_requested', $id)
            ->delete();
        return back()->with('msg', 'You are not friend with this person anymore');
    }
    public function ChangeUserPassword(User $user){

        return view('auth.changePW',compact('user'));
    }
}
