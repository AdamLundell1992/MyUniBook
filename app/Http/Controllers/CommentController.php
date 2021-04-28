<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, post $post) // store comments
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

    public function destroy(Request $request) // delete comments
    {

        $comment = Comment::findOrFail($request->comment);
        $post = post::findOrFail($request->post);

        $comment->delete();
        return redirect('/home');
    }
}
