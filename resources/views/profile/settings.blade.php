{{-- resources/views/profile/settings.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10 pt-24">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $user->name }}'s Profile</h2>

            <div class="flex items-center gap-4 mb-6">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="h-24 w-24 rounded-full object-cover border border-gray-300" alt="Profile Picture">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" class="h-24 w-24 rounded-full object-cover border border-gray-300" alt="Default Avatar">
                @endif
                <div>
                    <p class="text-gray-700"><strong>Email:</strong> {{ $user->email }}</p>
                </div>
            </div>

            <hr class="my-6">

            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Update Settings</h3>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" id="password"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture"
                           class="w-full text-sm text-gray-600">
                </div>

                <div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
