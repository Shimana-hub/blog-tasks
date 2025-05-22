<nav class="fixed top-0 w-full z-50 bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('posts.index') }}" class="flex items-center h-12">
            <img src="{{ asset('storage/images/logo6.png') }}" alt="Logo" class="h-40 w-auto object-contain block">
        </a>

        <!-- Navigation Links -->
        <div class="flex items-center gap-6 text-sm md:text-base">
            @auth
                <a href="{{ route('posts.create') }}" class="text-gray-600 hover:text-gray-900 transition">
                    Create Post
                </a>

                <span class="text-gray-600 hidden sm:inline">
                    Hi, {{ auth()->user()->name }}
                </span>

                <a href="{{ route('users.show', auth()->user()) }}" class="text-blue-600 hover:underline">
                    My Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition">Login</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 transition">Register</a>
            @endauth
        </div>
    </div>
</nav>
