@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <div class="">
                <div class="people-nearby">
                    <div class="nearby-user">
                        @if($users->isEmpty())
                            <div class="fw-bold pb-2">
                                Not found anything on your search try again
                            </div>
                            <div class="container-fluid">
                                <form class="d-flex" action="{{url('/search')}}">
                                    <input class="form-control me-2 @error('query')  border-red-500 @enderror"
                                           type="search" name="query" id="query" placeholder="Search"
                                           aria-label="Search">
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
                            $checkIfFriend1 = DB::table('friends')->where('user_requested', Auth::user()->id)->
                            where('acceptFriend', $user->id)->
                            where('status', 1)->first();
                            $checkIfFriend2 = DB::table('friends')->where('acceptFriend', Auth::user()->id)->
                            where('user_requested', $user->id)->
                            where('status', 1)->first();

                            ?>
                            <?php

                            /** @var TYPE_NAME $user */
                            $check = DB::table('friends')->where('user_requested', Auth::user()->id)
                                ->where('acceptFriend', $user->id)->where('status', 0)->first();

                            ?>

                            @if(!($checkIfFriend1 || $checkIfFriend2 || $user->id == Auth::user()->id ))

                                <div class="container">
                                    <div class="row row-cols-2">
                                        <div class="col">
                                            <div class="text-center card-box">
                                                <div class="member-card pt-2 pb-2">
                                                    <div class="mb-5 thumb-lg member-thumb mx-auto"><img
                                                            src="{{asset($user->image)}}"
                                                            class="img-thumbnail rounded-circle "
                                                            alt="profile-image"></div>
                                                    <div class="">
                                                        <h5 class="fw-bold" style="font-size: x-large">
                                                            <a href="{{url('checkProfile' . '/'. $user->id . '/')}} "
                                                               class="p-xxl-5 profile-link">


                                                                <i class="fas fa-user-circle"
                                                                   style="font-size: x-large"></i> {{$user->name}}
                                                            </a>
                                                        </h5>
                                                        <p class="fw-bold">Email <span>| </span><span><a href="#"
                                                                                                         class="text-pink"><i
                                                                        class="far fa-envelope"
                                                                        style="font-size: x-large"></i> {{$user->email}}</a></span>
                                                        </p>
                                                        <div class="profile-head">
                                                            <h5 class="fw-bold" style="font-size: x-large">
                                                                <i class="fas fa-graduation-cap"
                                                                   style="font-size: x-large"></i> {{$user->UniCourse}}
                                                            </h5>
                                                            <h5 class="fw-bold" style="font-size: x-large">
                                                                <p><i class="fas fa-school"
                                                                      style="font-size: x-large"></i> {{$user->university_year}}
                                                                </p>
                                                            </h5>
                                                            <h6 class="fw-bold pt-1" style="font-size: x-large">
                                                                <i class="far fa-calendar-alt"
                                                                   style="font-size: x-large"></i> {{$user->date_of_birth}}
                                                            </h6>
                                                            <h7 class="fw-bold pt-1" style="font-size: x-large">
                                                                <i class="fas fa-venus-mars"
                                                                   style="font-size: x-large"></i> {{$user->gender}}
                                                            </h7>
                                                        </div>
                                                    </div>
                                                    <ul class="social-links list-inline pt-2">
                                                        <li class="list-inline-item"><p title="" data-placement="top"
                                                                                        data-toggle="tooltip"
                                                                                        class="tooltips"><i
                                                                    class="fas fa-users"
                                                                    style="font-size: x-large"></i>
                                                            </p></li>
                                                        <li class="list-inline-item"><p title="" data-placement="top"
                                                                                        data-toggle="tooltip"
                                                                                        class="tooltips"><i
                                                                    class="far fa-handshake"
                                                                    style="font-size: x-large"></i>
                                                            </p></li>
                                                        <li class="list-inline-item"><p title="" data-placement="top"
                                                                                        data-toggle="tooltip"
                                                                                        class="tooltips"><i
                                                                    class="fas fa-university"
                                                                    style="font-size: x-large"></i>
                                                            </p></li>

                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- end col -->

                                            <?php
                                            if ($check == false ){
                                            ?>
                                            <div class="row pb-3">
                                                <div class="col-4">
                                                    <a href="{{url('addfriend' . '/'. $user->id . '/')}} "
                                                       class="p-xxl-5 profile-link">
                                                        <button class="btn btn-secondary btn-sm " type="submit"
                                                                value="yes"><i
                                                                class="fas fa-user-plus" style="font-size: x-large"></i>
                                                            Add
                                                            Friend
                                                        </button>
                                                    </a>
                                                </div>

                                                <?php   }else {?>
                                                <h3>Friend request sent</h3>


                                                <div class="col-5 pb-3">
                                                    <a href="{{url('deleteFriend' . $user->id . '/')}}"
                                                       class=" profile-link">
                                                        <button class="btn btn-secondary btn-sm"><i
                                                                class="fas fa-trash-alt"
                                                                style="font-size: x-large"></i>
                                                            Remove Friend Request
                                                        </button>
                                                    </a>
                                                </div>
                                                <?php      }
                                                ?>
                                            </div>
                                            {{--                            </div>--}}

                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
