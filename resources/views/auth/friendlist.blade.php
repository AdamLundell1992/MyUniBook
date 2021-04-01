@extends('layouts.app')

@section('content')

    <Header class="border-light fw-bold m-lg-5 " style="font-size: x-large">{{Auth::user()->name}}'s FriendList</Header>

    @if ( session()->has('msg') )
        <p class="alert alert-success">
            {{ session()->get('msg') }}
        </p>
    @endif
        @foreach($friends as $friend)
            <div class="row pb-5 m-lg-5 mt-5">
                <div class="col-md-2 col-sm-2">
                    <img src="{{asset($friend->image)}}" alt="user" class="profile-photo-lg">
                </div>
                <div class="col-md-7 col-sm-7">
                    <h5>{{$friend->name}}</h5>
                    <p>{{$friend->UniCourse}}</p>
                    <p class="text-muted">{{$friend->email}}</p>
                </div>
                <p class="mt-2">

                    <a href="{{url('unFriend' . $friend->id . '/')}}" class=" profile-link">
                        <button class="btn btn-secondary btn-sm ">Un-friend</button>
                    </a>

                </p>
            </div>
        @endforeach
{{--    @else--}}
{{--        <h2 class="text-center fw-bold">--}}
{{--            You have No friends yet--}}
{{--        </h2>--}}
{{--    @endif--}}



@endsection
