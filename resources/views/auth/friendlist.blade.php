@extends('layouts.app')

@section('content')

    <Header class="border-light fw-bold m-lg-5 " style="font-size: x-large">{{Auth::user()->name}}'s FriendList</Header>

    @if ( session()->has('msg') )
        <p class="alert alert-success">
            {{ session()->get('msg') }}
        </p>
    @endif
    <div class="content">
        @foreach($friends as $friend)
            <div class="container flex-lg-fill text-center">
                <div class="row ">
                </div>
                <div class="">
                    <div class="text-center card-box">
                        <div class="member-card pt-2 pb-2">
                            <div class="mb-5 thumb-lg member-thumb mx-auto"><img src="{{asset($friend->image)}}"
                                                                                 class="rounded-circle img-thumbnail"
                                                                                 alt="profile-image"></div>


                            <div class="">
                                <a href="{{url('checkProfile' . '/'. $friend->id . '/')}} "
                                   class="p-xxl-5 profile-link">
                                    <h5 class="fw-bold" style="font-size: x-large">
                                        <i class="fas fa-user-circle" style="font-size: x-large"></i> {{$friend->name}}
                                    </h5>
                                </a>
                                <p class="fw-bold">Email <span>| </span><span><a href="#"
                                                                                 class="text-pink">{{$friend->email}}</a></span>
                                </p>
                                <div class="profile-head">
                                    <h5 class="fw-bold" style="font-size: x-large">
                                        <i class="fas fa-graduation-cap"
                                           style="font-size: x-large"></i> {{$friend->UniCourse}}
                                    </h5>
                                    <h6 style="font-size: x-large">

                                    </h6>
                                </div>
                            </div>

                            <ul class="social-links list-inline pt-2">
                                <li class="list-inline-item"><p title="" data-placement="top" data-toggle="tooltip"
                                                                class="tooltips"><i class="fas fa-users"
                                                                                    style="font-size: x-large"></i>
                                    </p></li>
                                <li class="list-inline-item"><p title="" data-placement="top" data-toggle="tooltip"
                                                                class="tooltips"><i class="far fa-handshake"
                                                                                    style="font-size: x-large"></i>
                                    </p></li>
                                <li class="list-inline-item"><p title="" data-placement="top" data-toggle="tooltip"
                                                                class="tooltips"><i class="fas fa-university"
                                                                                    style="font-size: x-large"></i>
                                    </p></li>

                            </ul>
                            <a href="{{url('unFriend' . $friend->id . '/')}}" class=" profile-link pt-2">
                                <button
                                    class="btn btn-primary btn-sm  mt-3 btn-rounded waves-effect w-md waves-light ">
                                    <i class="fas fa-trash-alt" style="font-size: x-large"></i> Un-friend
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>

        @endforeach
    </div>

    {{--    @else--}}
    {{--        <h2 class="text-center fw-bold">--}}
    {{--            You have No friends yet--}}
    {{--        </h2>--}}
    {{--    @endif--}}



@endsection
