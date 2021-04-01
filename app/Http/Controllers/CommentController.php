<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request,post $post)
    {
        $post = post::findOrFail($request->post_id);
        $validatedAttributes = request()->validate([
            'comment' => ['required'],
        ]);
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment,Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }


    public function destroy(Request $request)
    {

        $comment = Comment::findOrFail($request->comment);
        $post = post::findOrFail($request->post);

        $comment->delete();
        return redirect('/home');
    }
}
