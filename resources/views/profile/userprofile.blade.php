@extends('layouts.app')

@section('content')
    <div class="container emp-profile">
            <div class="row">
                <div class="col-md-4">
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
                    <div class="profile-img">
                        <img src="{{ asset($user->image)}}" alt=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5 class="fw-bold" style="font-size: x-large">
                            <i class="fas fa-user-circle" style="font-size: x-large"></i> {{$user->name}}
                        </h5>
                        <h6 style="font-size: x-large">
                            <i class="fas fa-graduation-cap" style="font-size: x-large"></i> {{$user->UniCourse}}
                        </h6>
                        <h7 style="font-size: x-large">
                                    <p><i class="fas fa-school" style="font-size: x-large"></i> {{$user->university_year}}</p>
                        </h7>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p class="fw-bold pb-2" style="font-size: large"><i class="fas fa-info-circle" style="font-size: x-large"></i> About me</p>
                        {{$user->user_info}}

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p> <i class="fas fa-user-circle" style="font-size: x-large"></i> {{$user->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="far fa-envelope" style="font-size: x-large"></i>{{$user->email}}</p>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Date Of Birth</label>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="far fa-calendar-alt" style="font-size: x-large"></i> {{$user->date_of_birth}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Gender</label>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="fas fa-venus-mars" style="font-size: x-large"></i> {{$user->gender}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{--                            </div>--}}

                </div>
        <?php

        /** @var TYPE_NAME $user */
        $check = DB::table('friends')->where('user_requested',Auth::user()->id)
            ->where('acceptFriend',$user->id)->where('status',0)->first();

        ?>
        <?php
        if ($check == false ){
        ?>
        <div class="row ">
            <div class="">
                <a href="{{url('addfriend' . '/'. $user->id . '/')}} "class= "p-xxl-5 profile-link">
                    <button class="btn btn-primary btn-sm "  type="submit" value="yes"><i class="fas fa-user-plus" style="font-size: x-large"></i> Add Friend</button>
                </a>
            </div>

            <?php   }else {?>
            <h3>Friend request sent</h3>



            <div class="col-5">
                <a href="{{url('deleteFriend' . $user->id . '/')}}" class=" profile-link">
                    <button class="btn btn-primary btn-sm"> <i class="fas fa-trash-alt" style="font-size: x-large"></i> Remove Friend Request</button>
                </a>
            </div>
            <?php      }
            ?>
                    @endforeach
                </div>
            </div>
    </div>
{{--<div class="container border bg-light bg-light">--}}
{{--    <div class="row">--}}
{{--        <div class="col light bg-light" style="width: 18rem;">--}}
{{--            @foreach($users as $user)--}}
{{--            <header--}}
{{--                class=" fs-4 font-semibold bg-light py-3 px-4 sm:py-5 sm:px-4 sm:rounded-t-md">{{$user->name}}--}}
{{--            </header>--}}
{{--            <img src="{{ asset($user->image)}}" class=" bg-light" alt="...">--}}
{{--        </div>--}}
{{--        <div class="col">--}}
{{--            <label class="fs-4 font-semibold bg-light py-3 px-4 sm:py-5 sm:px-4 sm:rounded-t-md"> <i class="fas fa-info-circle" style="font-size: x-large"></i> About me: </label>--}}
{{--            <p class="fs-5 font-semibold bg-white-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md " >--}}
{{--                <strong>{{$user->user_info}}</strong></p>--}}

{{--        </div>--}}
{{--        <div class="container ">--}}
{{--            <strong>{{$user->date_of_birth}}</strong></p>--}}
{{--        </div>--}}
{{--@endforeach--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
