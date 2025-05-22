@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10 pt-24">
    <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h1 class="text-4xl font-bold text-pink-600 mb-4">{{ $post->title }}</h1>
        <p class="text-gray-700 leading-relaxed">{{ $post->body }}</p>

        <div class="mt-8 flex items-center gap-3 text-sm text-gray-500">
            @if($post->user && $post->user->profile_picture)
                <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-10 w-10 object-cover">
            @else
            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="rounded-full h-10 w-10 object-cover">
            @endif
            <span>
                Posted by: <strong>{{ $post->user->name ?? 'Anonymous' }}</strong>
            </span>
        </div>

    </div>

    @if(auth()->check() && auth()->id() === $post->user_id)
    <div class="mt-6 flex gap-4">
        <a href="{{ route('posts.edit', $post) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Edit
        </a>

        <form method="POST" action="{{ route('posts.destroy', $post) }}"
              onsubmit="return confirm('Are you sure you want to delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                Delete
            </button>
        </form>
    </div>
    @endif

    <hr class="my-10">

    <h2 class="text-2xl font-semibold mb-4">Comments</h2>

    @forelse($post->comments as $comment)
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 shadow-md">
    <p class="text-gray-800 text-base">{{ $comment->body }}</p>
    <div class="mt-5 flex items-center gap-3 text-sm text-gray-500">
        @if($comment->user && $comment->user->profile_picture)
            <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-6 w-6 object-cover">
        @else
            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="rounded-full h-6 w-6 object-cover">
        @endif

        <span class="text-xs text-gray-500 mt-1">
            <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>, {{ $comment->created_at->diffForHumans() }}
        </span>
    </div>

    @if(auth()->id() === $comment->user_id)
        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="absolute top-2 right-4">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this comment?')" class="text-red-500 text-sm">
                Delete
            </button>
        </form>
    @endif

    {{-- Replies --}}
    @if($comment->replies->count())
        <button 
            onclick="document.getElementById('replies-{{ $comment->id }}').classList.toggle('hidden')" 
            class="ml-1 mt-4 text-sm text-pink-600 hover:underline focus:outline-none">
            View {{ $comment->replies->count() }} {{ Str::plural('reply', $comment->replies->count()) }}
        </button>
    @endif

    {{-- Replies Container --}}
    <div id="replies-{{ $comment->id }}" class="hidden mt-4">
        @foreach($comment->replies as $reply)
            <div class="ml-6 mt-4 p-4 rounded-xl bg-pink-50 border border-pink-200 relative shadow-sm">
                <div class="text-gray-800 text-sm">{{ $reply->body }}</div>
                <div class="mt-4 flex items-center gap-3 text-sm text-gray-500">
                    @if($reply->user && $reply->user->profile_picture)
                        <img src="{{ asset('storage/' . $reply->user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-5 w-5 object-cover">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="rounded-full h-5 w-5 object-cover">
                    @endif
                    <span class="text-xs text-gray-500 mt-1">
                        <strong>{{ $reply->user->name ?? 'Anonymous' }}</strong>, {{ $reply->created_at->diffForHumans() }}
                    </span>
                </div>

                @if(auth()->id() === $reply->user_id)
                    <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this reply?')" class="text-red-500 text-xs">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Reply Form --}}
    @auth
        <form method="POST" action="{{ route('comments.reply') }}" class="ml-2 mt-4">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

            <textarea name="body" rows="2" class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-2 focus:ring-pink-400 focus:outline-none text-sm" placeholder="Write a reply..." required></textarea>

            @error('body')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-2 bg-pink-500 hover:bg-pink-600 text-white text-xs font-semibold px-4 py-2 rounded transition-all duration-200">
                Reply
            </button>
        </form>
    @endauth
</div>

    
    @empty
        <p class="text-gray-500">No comments yet.</p>
    @endforelse


    @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="body" rows="3" class="w-full border border-gray-300 p-2 rounded" placeholder="Write a comment..." required></textarea>
            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded mt-2 hover:bg-pink-700 transition">
                Post Comment
            </button>
        </form>
    @endauth

    @guest
        <p class="mt-6 text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-pink-600 underline">log in</a> to comment.</p>
    @endguest

</div>
@endsection

