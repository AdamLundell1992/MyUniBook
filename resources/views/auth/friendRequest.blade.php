@extends('layouts.app')

@section('content')

    <Header class="border-light fw-bold m-lg-5 " style="font-size: x-large">Friend Requests</Header>

    @if($users->count()>0)
    @foreach($users as $user)

        <?php
        /** @var TYPE_NAME $user */
        $check = DB::table('friends')->where('acceptFriend',$user->id)->where('status',1)->get();
        if ($check == true){
        ?>
        <div class="row pb-5 m-lg-5 mt-5">
            <div class="col-md-2 col-sm-2">
                <img src="{{asset($user->image)}}" alt="user" class="profile-photo-lg">
            </div>
            <div class="col-md-7 col-sm-7">
                <h5>{{$user->name}}</h5>
                <p>{{$user->UniCourse}}</p>
                <p class="text-muted">{{$user->email}}</p>
{{--                <div class="col-md-3 col-sm-3">--}}
                    <div class="row mt-2">
                        <div class="col-4">
                            <a href="{{url('confirmRequest' . $user->id . '/')}}" class="profile-link">
                                <button class="btn btn-secondary btn-sm ">Accept friend</button>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="{{url('deleteRequest' . $user->id . '/')}}" class=" profile-link">
                                <button class="btn btn-secondary btn-sm">Decline Friend request</button>
                            </a>
                        </div>
                    </div>
            </div>


            </div>
     <?php   }?>
    @endforeach
    @else
    <h2 class="text-center fw-bold">
        You have No friend Request
    </h2>
        @endif



@endsection
