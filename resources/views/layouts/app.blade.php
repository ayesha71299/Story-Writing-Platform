<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .lilac-bg {
                background-color: #E6C9F9;
            }
            .lilac-text {
                color: #6A0DAD;
            }
            .lilac-border {
                border-color: #C5A3E8;
            }
            .page-container {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            .content-wrap {
                flex: 1;
            }
        </style>
    </head>
    <body class="font-sans antialiased lilac-bg">
        <div class="page-container">
            <!-- Navbar -->
            <nav class="bg-purple-700 text-white py-4 shadow-lg">
                <div class="container mx-auto flex justify-between items-center px-6">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-white hover:text-lilac-700">
                        {{ config('app.name', 'Story App') }}
                    </a>
                    <div class="flex items-center space-x-6">
                        <!-- Stories Button -->
                        <a href="{{ route('stories.index') }}" class="px-4 py-2 rounded-lg bg-white text-purple-700 hover:bg-gray-200">
                            Stories
                        </a>
                        @auth
                            <div class="relative">
                                <button id="notificationsDropdownBtn" class="relative px-4 py-2 bg-white text-purple-700 rounded-lg hover:bg-gray-200">
                                    Notifications
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <span class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                                            {{ auth()->user()->unreadNotifications->count() }}
                                        </span>
                                    @endif
                                </button>
                                <div id="notificationsDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg z-10">
                                    <ul class="divide-y divide-gray-200">
                                        @forelse(auth()->user()->unreadNotifications as $notification)
                                            <li class="px-4 py-2 text-gray-700 flex justify-between items-center">
                                                <span>{{ $notification->data['message'] }}</span>
                                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-blue-500">View</button>
                                                </form>
                                            </li>
                                        @empty
                                            <li class="px-4 py-2 text-gray-500 text-center">No new notifications</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-white text-purple-700 hover:bg-gray-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-white text-purple-700 hover:bg-gray-200">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="ml-2 px-4 py-2 rounded-lg bg-purple-500 text-white hover:bg-purple-600">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>
            <div class="content-wrap">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow lilac-border">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 lilac-text">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="container mx-auto px-4 py-6 bg-white shadow-md rounded-lg mt-6">
                    @yield('content')
                </main>
            </div>

            <footer class="bg-purple-700 text-white text-center py-4 mt-auto">
                <p>&copy; {{ date('Y') }} Story App - A Collaborative Writing Platform</p>
            </footer>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dropdownBtn = document.getElementById('notificationsDropdownBtn');
                const dropdownMenu = document.getElementById('notificationsDropdown');

                if (dropdownBtn) {
                    dropdownBtn.addEventListener('click', function () {
                        dropdownMenu.classList.toggle('hidden');
                    });

                    document.addEventListener('click', function (event) {
                        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                            dropdownMenu.classList.add('hidden');
                        }
                    });
                }
            });
        </script>
    </body>
</html>
