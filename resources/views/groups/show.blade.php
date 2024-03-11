<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl dark:text-white leading-tight">
                {{ __('Group') }}: {{ $group->name ?? 'No name'}}
            </h2>
            <x-link :href="route('groups.edit', $group->slug)" class="text-cyan-400 hover:text-white bg-cyan-950">
                {{ __('Edit Group') }}
            </x-link>
        </div>
    </x-slot>
    
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-8">
                    {{-- Displaying tasks --}}
                    <div class="dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-3">
                        <h3 class="dark:text-white text-lg font-semibold mb-4">Tasks</h3>
                        <x-link :href="route('group.tasks.create', $group->slug)" class="dark:bg-blue-400 hover:bg-blue-700 dark:hover:bg-blue-600">
                            {{ __('Create Task') }}
                        </x-link>
                        
                    </div>

                    {{-- Displaying group activity --}}
                    <div class="dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-3">
                        <h3 class="dark:text-white text-lg font-semibold mb-4">Activity</h3>
                        <div class="border border-gray-200 rounded-lg p-4">
                            {{-- Loop through activity --}}
                            {{-- @forelse ($group->activity as $activity)
                                <div class="flex items center justify-between mb-2">
                                    <div>
                                        <h4 class="font-semibold">{{ $activity->description }}</h4>
                                        <p class="text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>

                                    <div>
                                        <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded">{{ ucfirst($activity->type) }}</span>
                                    </div>
                                </div>
                            @empty
                                <p>No activity found.</p>
                            @endforelse --}}
                            <h1 class="dark:text-white">Activity is shown here!</h1>
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    {{-- Add members dropdown --}}
                    <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4 text-white">Add Members</h3>
                        <form method="POST" action="{{ route('groups.members.add', $group->slug) }}">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <div class="mb-4">
                                <label for="users" class="block font-bold text-white">Select User</label>
                                <select id="users" name="users[]" class="form-select mt-1 block w-full bg-gray-900 text-white" multiple>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Member</button>
                            </div>
                        </form>
                    </div>
                    
                    {{-- Display group members --}}
                    <div class="dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6 mt-2">
                        <h3 class="text-lg font-semibold mb-4 dark:text-white">Group Members</h3>
                        @if ($group->members->isNotEmpty())
                            <ul class="dark:text-white">
                                @foreach ($members as $member)
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center mb-2">
                                            @if ($member->avatar)
                                                <img src="{{ asset('storage/' . $member->avatar) }}" alt="{{ $member->name }}'s avatar" class="w-8 h-8 rounded-full mr-2">
                                            @else
                                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold mr-2">
                                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            {{ optional($member->user)->name }}
                                        </div>
                                        <button class="eye-btn" data-user-id="{{ $member->id }}">👁️</button>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="dark:text-white">No members added to this group yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
