@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10 bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        @csrf
                        <a class="nav-link fw-bold" aria-current="page" href="/auth/{{Auth::user()->id}}/edit"> <i
                                class="fas fa-user-edit" style="font-size: x-large;color: #010203"></i> Change
                            your profile</a>
                        <a class="nav-link fw-bold" aria-current="page" href="posts/create"><i
                                class="fas fa-book-reader" style="font-size: x-large;color: #010203"></i> Create new
                            post</a>
                        <a class="nav-link fw-bold" aria-current="page" href="messages/index"> <i
                                class="fab fa-facebook-messenger" style="font-size: x-large;color: #010203"></i>
                            Messages
                            <i class="fas fa-arrow-circle-right" style="font-size: x-large;color: #0062cc"> {{App\Models\Message::where('is_read', '0')->
where('from','!=',Auth::user()->id)
           ->count()}}</i>
                        </a>
                        <a class="nav-link fw-bold" aria-current="page" href="showFriendRequest"
                        ><i class="fas fa-users" style="font-size: x-large;color: #010203"></i> Friend Requests
                            <i class="fas fa-arrow-circle-right" style="font-size: x-large; color: #0062cc"> {{App\Models\friend::where('status', 0)->where('acceptFriend',Auth::user()->id
        )->count()}}</i>

                        </a>

                        <a class="nav-link fw-bold" aria-current="page" href="friendsList"><i
                                class="fas fa-address-book" style="font-size: x-large;color: #010203"></i>
                            Friend-List</a>
                    </div>

                    <nav class="navbar navbar-light bg-light">
                        <div class="container-fluid">
                            <form class="d-flex" action="{{url('/search')}}">
                                <input class="form-control me-2 @error('query')  border-red-500 @enderror" type="search"
                                       name="query" id="query" placeholder="Search Friends" aria-label="Search">
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-search"
                                                                                      style="font-size: x-large;color: #010203"></i>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
                <ul class="errors text-red-500 text-xs italic mt-4">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <div class="container emp-profile">
            <div class="row">
                <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{ asset(Auth::user()->image)}}" alt=""/>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5 class="fw-bold" style="font-size: x-large">
                            <i class="fas fa-user-circle" style="font-size: x-large"></i> {{Auth::user()->name}}
                        </h5>
                        <h6 style="font-size: x-large">
                            <i class="fas fa-graduation-cap" style="font-size: x-large"></i> {{Auth::user()->UniCourse}}
                        </h6>
                        <h7 style="font-size: x-large">
                            <p><i class="fas fa-school" style="font-size: x-large"></i> {{Auth::user()->university_year}}</p>
                        </h7>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p class="fw-bold pb-2" style="font-size: large"><i class="fas fa-info-circle" style="font-size: x-large"></i> About me</p>
                        {{Auth::user()->user_info}}

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
                                    <p> <i class="fas fa-user-circle" style="font-size: x-large"></i> {{Auth::user()->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="far fa-envelope" style="font-size: x-large"></i>{{Auth::user()->email}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date Of Birth</label>
                            </div>
                            <div class="col-md-6">
                                <p><i class="far fa-calendar-alt" style="font-size: x-large"></i> {{Auth::user()->date_of_birth}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Gender</label>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-venus-mars" style="font-size: x-large"></i> {{Auth::user()->gender}}</p>
                            </div>
                        </div>
                    </div>

            </div>

        </div>
        </div>
        <div class="container pb-5">
            <div class=" w-full pb-4">
                <td class="container flex   pb-5 sm:exmax-w-lg sm:mt-10">
                    @foreach($posts as $post)
                        <section
                            class=" flex flex-col break-words  sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
                            <header
                                class="mt-5 font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                                <div class="fs-3">
                <td class="fw-bold"> Posted by: {{ !empty($post->user) ? $post->user->name:'' }} </td>
            </div>
            <div class="mt-3">

                <small class="fs-6">post posted: {{$post->created_at}} </small>
            </div>
            </header>
            <div class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-4">

                <div class=" mt-3  px-6 space-y-6 sm:px-10 sm:space-y-8 mb-4">
                    <img src="{{ asset($post->image)}}" style=" object-fit:contain" alt="thumbnail">
                </div>


            @can('view',$post)
        <div class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-4">
        <div class="row ">
            <div class="col-2 ">
                <a href="/posts/{{$post->id}}/edit">
                    <button type="button" class="btn btn-primary btn-sm  mt-3 btn-rounded waves-effect w-md waves-light "><i class="fas fa-edit" style="font-size: x-large"></i> Edit post
                    </button>
                </a>
            </div>
            @endcan
            @can('view',$post)
                <div class="col-2 ">
                    <form method="POST" action="/posts/{{$post->id}}/destroy">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary btn-sm  mt-3 btn-rounded waves-effect w-md waves-light ">
                            <i class="fas fa-trash-alt" style="font-size: x-large"></i> Delete Post
                        </button>
                    </form>

                </div>
            @endcan
        </div>

        <article class=" mt-3 w-full rows=3 w-full px-6 space-y-6 sm:px-10 sm:space-y-8">
            <div class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
            <p >{{$post->post}}</p>
            </div>
            <div class="col-span-2">
                <h4 class="text-2xl">Add comment</h4>
                <form method="post" action="/posts/{{$post->id}}">
                    @csrf
                    <textarea type="text" name="comment" @error('comment') is-danger @enderror
                    class=" border-8 "
                              style="height: 112px; width:300px; "></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mt-3 mb-3 for-group">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                            <i class="fas fa-comments" style="font-size: x-large"></i> Submit Comment
                        </button>
                    </div>
                    @error('comment')
                    <p class="text-red-500 text-xs italic mt-4 font-bold text-lg">{{$errors->first('comment')}}  </p>
                    @enderror
                </form>
                @foreach($post->comments as $comment)
                    <div
                        class=" display-comment h-16 border-4 mb-1 pt-2 border-light-blue-500 border-opacity-100 rounded-lg "
                        style="height: 70px; width:300px;">
                        <text class="ml-3 font-bold">{{$comment->user['name']}}:</text>
                        <p class="mt-2 ml-4 word-wrap: break-word;"
                           style="white-space: pre-wrap;">{{ $comment->comment }}</p>
                    </div>
                    @can('view',$comment)
                        <div class="pt-2 pb-2">
                            <form method="POST" action="{{route("delete_comment")}}">
                                @csrf
                                @method('DELETE')
                                <label for="comment" class="hidden"></label>
                                <input class="hidden" name="comment"
                                       value="{{$comment->id}}"
                                       content="{{$comment->id}}">
                                <label for="post" class="hidden"></label>
                                <input class="hidden" name="post" value="{{$post->id}}"
                                       content="{{$post->id}}">
                                <button type="submit" class="btn btn-primary btn-sm  mt-3 btn-rounded waves-effect w-md waves-light ">
                                    <i class="fas fa-trash-alt" style="font-size: x-large"></i> delete comment
                                </button>
                            </form>
                        </div>
            </div>
            @endcan
            @endforeach
        </article>
</div>


</div>

</section>

@endforeach
</div>
</div>
</main>
@endsection
