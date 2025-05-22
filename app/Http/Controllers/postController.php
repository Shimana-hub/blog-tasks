<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get(); 
        return view('posts.index', compact('posts')); 
    }

    public function create()
    {
        return view('posts.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);
        
        return redirect()->route('posts.index')->with('success', 'Post created!'); 
    }

    public function show(Post $post)
    {
        $post->load(['comments' => function ($query) {
            $query->whereNull('parent_id')->with(['replies.user', 'user']);
        }, 'user']);

    return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    public function update (Request $request, Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated!'); 
    }

    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }
        
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted!'); 
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
