@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 pt-24">
    <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Body</label>
            <textarea name="body" rows="6"
                      class="w-full border px-3 py-2 rounded" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
            Update Post
        </button>
    </form>
</div>
@endsection
