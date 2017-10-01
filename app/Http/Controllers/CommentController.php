<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use App\User;
use App\Post;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $post = Post::with(['user'])->findOrFail($post_id);
        $comments = Comment::with(['user'])->where('post_id', $post_id)->get();
        return view('comments.index', compact('comments', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        $post = Post::with(['user'])->findOrFail($post_id);
        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(CommentRequest $request, $post_id)
     {
         $comment = $request->all();
         $comment['user_id'] = Auth::user()->id;
         $comment['post_id'] = $post_id;
         Comment::create($comment);
         return redirect()->route('comments', ['post_id' => $post_id])->with('message', 'Comment has been added successfully');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id, $comment_id)
    {
        $post = Post::with(['user'])->findOrFail($post_id);
        $comment = Comment::with(['user'])->findOrFail($comment_id);
        return view('comments.edit', compact('post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $post_id, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->update($request->all());
        return redirect()->route('comments', ['post_id' => $post_id])->with('message', 'Comment has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        return redirect()->route('comments', ['post_id' => $post_id])->with('message', 'Comment has been deleted successfully');
    }
}
