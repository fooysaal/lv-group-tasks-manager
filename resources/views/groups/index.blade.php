<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-white font-semibold text-xl leading-tight">
                {{ __('Groups') }}
            </h2>
            {{-- Add success message --}}
            @if (session('success'))
                <div class="flex justify-center mb-4">
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

            <x-link :href="route('groups.create')" class="text-cyan-400 hover:text-white bg-cyan-950">
                {{ __('Create Group') }}
            </x-link>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($groups as $group)
                <div class="bg-gray-700 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $group->image) }}" alt="{{ $group->name }}" class="w-full h-56">
                    <div class="p-4">
                        <h1 class="text-2xl font-semibold text-white">{{ $group->name }}</h1>
                        <p class="mt-2 text-gray-400">{{ $group->description }}</p>
                        <div class="mt-4">
                            <x-link :href="route('groups.show', $group->slug)" class="text-indigo-500 hover:text-white">
                                View Group
                            </x-link>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-700 rounded-lg overflow-hidden shadow-lg p-6">
                    <h1 class="text-2xl font-medium text-white">You have no groups!</h1>
                    <p class="mt-4 text-gray-500 leading-relaxed">
                        You can create a group by clicking the button below.
                    </p>
                    <div class="mt-4">
                        <x-link :href="route('groups.create')" class="text-indigo-500 hover:text-white">
                            Create a Group
                        </x-link>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
