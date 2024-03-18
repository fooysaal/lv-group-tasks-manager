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
            <div class="relative">
                <button id="notificationButton" class="flex items-center focus:outline-none">
                    <svg class="h-5 w-5 text-gray-600 dark:text-violet-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19v3m0 0v-3m0 3c-2.2 0-4-1.8-4-4V10a6 6 0 1112 0v8c0 2.2-1.8 4-4 4z" />
                    </svg>
                    <div id="notificationCounter" class="top-0 right-0 text-red-500 w-2 h-2 rounded-full flex justify-center items-center absolute">
                        {{ count($notifications) }}
                    </div>
                </button>
                <div id="notificationDropdown" class="absolute right-0 mt-2 w-80 max-h-60 overflow-y-auto bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 shadow-lg py-1 z-10 hidden">
                    {{-- if has notification --}}
                    @if (count($notifications) > 0)
                        @foreach ($notifications as $notification)
                            <a href="{{ route('update-group-status', $notification->id) }}" class="block px-2 py-1 text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900">
                                {{ $notification->group->name }}
                                <span class="text-xs block">
                                    You are invited to join this group.
                                </span>
                                <form action="{{ route('update-group-status', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex justify-between mt-2">
                                        <button type="submit" name="status" value="approved" class="bg-blue-500 hover:bg-blue-700 text-white p-1 font-sm rounded">
                                            Accept
                                        </button>
                                        <button type="submit" name="status" value="rejected" class="bg-red-500 hover:bg-red-700 text-white py-1 px-1 font-sm rounded">
                                            Decline
                                        </button>
                                    </div>
                                </form>
                            </a>
                        @endforeach
                    @else
                        <p class="block px-2 py-1 dark:text-white">
                            You have no pending group requests.
                        </p>
                    @endif
                </div>
            </div>             
        </div>
    </x-slot>

    <div class="py-6 shadow-xl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
                        {{-- if have any notification display message --}}
                        @if (count($notifications) > 0)
                            <p class="text-gray-600 dark:text-gray-300">You have {{ count($notifications) }} pending group requests.</p>
                        @else
                            <p class="text-gray-600 dark:text-gray-300">You have no pending group requests.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('notificationButton').addEventListener('click', function() {
        document.getElementById('notificationDropdown').classList.toggle('hidden');
    });
</script>