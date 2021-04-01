@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <p class="font-bold text-2xl mb-15">Posts</p>

        @csrf
        <div class="row equal-height">
            <div class="grid grid-cols-3 gap-4  ">
                @foreach($posts as $post)
                    <a href="posts/{{$post->id}}">

                        <div style="height: 250px">
                            <td><img src="{{ asset($post->image)}}" style="width: 100%;max-height: 100%; object-fit:
                            contain" alt="thumbnail"></td>
                        </div>
                        <div class="font-bold text-xl mb-3">{{$post->post}}</div>
                    </a>

                @endforeach
            </div>
        </div>
    </main>
@endsection
