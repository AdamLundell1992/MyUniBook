@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="people-nearby">
                    <div class="nearby-user">
                        @if($users->isEmpty())
                            <div class="fw-bold pb-2">
                            Not found anything on your search try again
                            </div>
                            <div class="container-fluid">
                                <form class="d-flex" action="{{url('/search')}}">
                                    <input class="form-control me-2 @error('query')  border-red-500 @enderror" type="search" name="query" id="query" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        @endif
                        @if(session()->has('alreadyfriends'))
                                <p class="fw-bold alert alert-success">
                                    {{session()->get('alreadyfriends')}}
                                </p>
                            @endif
                            @if(session()->has('notAdd'))
                                <p class="fw-bold alert alert-success">
                                    {{session()->get('notAdd')}}
                                </p>
                            @endif
                                @if(session()->has('addf'))
                                    <p class="fw-bold alert alert-success">
                                        {{session()->get('addf')}}
                                    </p>
                                @endif
                            @if(session()->has('delef'))
                                <p class="fw-bold alert alert-success">
                                    {{session()->get('delef')}}
                                </p>
                            @endif


                        @foreach($users as $user)

                                <?php

                                /** @var TYPE_NAME $user */
                                $check = DB::table('friends')->where('user_requested',Auth::user()->id)
                                ->where('acceptFriend',$user->id)->where('status',0)->first();

                                    ?>

                        <div class="row pb-5">
                            <div class="col-md-2 col-sm-2">
                                <img src="{{asset($user->image)}}" alt="user" class="profile-photo-lg">
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <h5>{{$user->name}}</h5>
                                <p>{{$user->UniCourse}}</p>
                                <p class="text-muted">{{$user->email}}</p>
                            </div>
                            <?php
                            if ($check == false ){
                            ?>
                                <div class="row ">
                                    <div class="col-4">
                                <a href="{{url('addfriend' . '/'. $user->id . '/')}} "class= "p-xxl-5 profile-link">
                                <button class="btn btn-secondary btn-sm " type="submit" value="yes">Add Friend</button>
                                </a>
                                    </div>

                                    <?php   }else {?>
                                    <h3>Friend request sent</h3>



                                    <div class="col-5">
                                <a href="{{url('deleteFriend' . $user->id . '/')}}" class=" profile-link">
                                    <button class="btn btn-secondary btn-sm">Remove Friend Request</button>
                                </a>
                                    </div>
                                    <?php      }
                                    ?>
                                </div>
{{--                            </div>--}}

                        </div>

                            @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
