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
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    {{-- cards starts here --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-full" src="" alt="Group">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Groups</div>
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100"></div>
                                    </div>
                                    <div class="ml-4">
                                        <a href="" class="text-sm font-medium text-blue-600 dark:text-blue-400">View</a>
                                    </div>
                                    <div class="ml-4">
                                        <a href="" class="text-sm font-medium text-blue-600 dark:text-blue-400">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-full" src="" alt="Group">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Assigned Task</div>
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100"></div>
                                    </div>
                                    <div class="ml-4">
                                        <a href="" class="text-sm font-medium text-blue-600 dark:text-blue-400">View</a>
                                    </div>
                                    <div class="ml-4">
                                        <a href="" class="text-sm font-medium text-blue-600 dark:text-blue-400">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
