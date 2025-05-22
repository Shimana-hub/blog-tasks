@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 pt-24">
    <h1 class="text-4xl font-bold text-pink-600 mb-6">All Blog Posts</h1>

    @foreach ($posts as $post)
        <div class="mb-6 p-6 bg-white rounded-2xl shadow-lg hover:shadow-pink-300 transition">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $post->title }}</h2>
            <p class="text-gray-600 mt-2">{{ Str::limit($post->body, 100) }}</p>
            <a href="{{ route('posts.show', $post) }}"
               class="inline-block mt-4 text-pink-600 hover:text-pink-800 font-medium">
                Read More →
            </a>
        </div>
    @endforeach
</div>
@endsection
