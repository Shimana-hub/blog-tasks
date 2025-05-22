{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 pt-24">
    <div class="bg-white shadow p-6 rounded-xl">
        <h2 class="text-2xl font-bold mb-4">{{ $user->name }}'s Profile</h2>

        @if($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="h-24 w-24 rounded-full mb-4" alt="Profile Picture">
        @endif

        <p><strong>Email:</strong> {{ $user->email }}</p>
        @if(auth()->id() === $user->id)
        <a href="{{ route('profile.settings') }}" class="text-gray-600 hover:text-gray-900" title="Settings">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                class="lucide lucide-settings">
                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
        </a>


        @endif




        <hr class="my-6">

        <h3 class="text-xl font-semibold mb-3">Your Posts</h3>

        @forelse ($user->posts as $post)
            <div class="mb-4">
                <a href="{{ route('posts.show', $post) }}" class="text-pink-600 font-medium">
                    {{ $post->title }}
                </a>
            </div>
        @empty
            <p class="text-gray-500">No posts yet.</p>
        @endforelse
    </div>
</div>


@endsection
