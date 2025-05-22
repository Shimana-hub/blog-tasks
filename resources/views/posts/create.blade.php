@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-pink-600 mb-6 pt-24">Create a New Post</h1>

    <form method="POST" action="{{ route('posts.store') }}" class="bg-white p-6 rounded-xl shadow-md space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Body</label>
            <textarea name="body" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none">{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-full shadow transition">
            Publish Post
        </button>
    </form>
</div>
@endsection
