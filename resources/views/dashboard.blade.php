<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            @if (session('success'))
                <div class="flex justify-center m-0">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex items-center">
                        <strong class="font-bold mr-2">Success!</strong>
                        <span class="block">{{ session('success') }}</span>
                        {{-- Add a close button --}}
                        <span class="ml-auto">
                            <svg onclick="this.parentElement.parentElement.style.display = 'none'" class="fill-current h-6 w-6 text-green-500 cursor-pointer" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1 1 0 01-1.497-1.316l1.849-2.5-1.849-2.5a1 1 0 111.497-1.316l1.849 2.5 1.849-2.5a1 1 0 111.497 1.316l-1.849 2.5 1.849 2.5a1 1 0 01.001 1.316l-1.849 2.5a1 1 0 01-1.498 0l-1.849-2.5-1.849 2.5a1 1 0 01-.001 1.316l.001.001z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            @endif

            {{-- add a notification dropdown --}}
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="flex items-center focus:outline-none">
                    <!-- Notification icon -->
                    <svg class="h-6 w-6 text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Notification icon path -->
                    </svg>
                    
                    <!-- Notification count badge -->
                    <div x-show="open && {{ count($notifications) }} > 0" class="top-0 right-0 text-red-500 w-2 h-2 rounded-full flex justify-center items-center absolute">
                        {{ count($notifications) }}
                    </div>
                </button>
            
                <!-- Notification dropdown -->
                <div x-show="open" class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 shadow-lg py-1 z-10">
                    <!-- Check if there are notifications -->
                    @if ($notifications->isNotEmpty())
                        <!-- Iterate through notifications -->
                        @foreach ($notifications as $notification)
                        <p class="text-gray-400 text-xs px-4 py-1">New group request</p>
                            <a href="{{ route('update-group-status', $notification->id) }}" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">
                                <!-- Display notification content -->
                                {{ $notification->group->name }}
                                <!-- Add animation here -->
                            </a>
                            
                        @endforeach
                    @else
                        <!-- Display empty state -->
                        <div class="px-4 py-2 text-gray-800 dark:text-gray-200">No new notifications</div>
                    @endif
                </div>
            </div>            
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
                        <p class="text-gray-600 dark:text-gray-400">Here's a quick overview of your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
