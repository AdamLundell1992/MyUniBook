@extends('layouts.app')

@section('content')
    <div id="wrapper ">
        <form method="POST" action="/posts" enctype="multipart/form-data">
            @csrf
            <div class="col">
                <div class="w-full p-6">
                    <div class=" control mb-3">
                        <label for="post"  class="form-label">New Post</label>
                        <textarea class="form-control" id="post" name="post" rows="3" type="text"></textarea>

                      </div>
                    <div class=" control mb-3">
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="field is-grouped flex flex-wrap flex items-center">
                        <div class="control pb-8">
                            <a href="posts/index">
                            <button
                                class="button is-link bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded  ">
                                Submit post
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
