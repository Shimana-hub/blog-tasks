<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->body = $validated['body'];
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'Comment added!');
    }

    public function destroy(Comment $comment)
    {
    if (auth()->id() !== $comment->user_id) {
        abort(403);
    }

    $comment->delete();

    return back()->with('success', 'Comment deleted successfully.');
    }


    public function reply(Request $request)
    {
    $validated = $request->validate([
        'body' => 'required|string|max:1000',
        'post_id' => 'required|exists:posts,id',
        'parent_id' => 'required|exists:comments,id',
    ]);

    $reply = new Comment();
    $reply->body = $validated['body'];
    $reply->user_id = auth()->id();
    $reply->post_id = $validated['post_id'];
    $reply->parent_id = $validated['parent_id'];
    $reply->save();
    

    return redirect()->route('posts.show', $validated['post_id'])->with('success', 'Reply added!');
    }

}
