<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Group') }}: {{ $group->name }}
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
                    {{-- Task creation form --}}
                    <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-white text-lg font-semibold mb-4">Create Task</h3>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Task Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Task Description')" />
                                <x-text-area id="description" class="block mt-1 w-full" name="description"> {{ old('description') }} </x-text-area>
                            </div>
                            <div class="mb-4">
                                <x-input-label for="status" :value="__('Task Status')" />
                                <select id="task_status" name="status" class="form-select mt-1 block w-full bg-gray-900 text-white">
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="assigned">Assigned</option>
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                            </div>
                        </form>
                    </div>
                    
                    {{-- Displaying tasks --}}
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Tasks</h3>
                        <div class="border border-gray-200 rounded-lg p-4">
                            {{-- Loop through tasks --}}
                            {{-- @forelse ($group->tasks as $task)
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h4 class="font-semibold">{{ $task->name }}</h4>
                                        <p class="text-gray-500">{{ $task->description }}</p>
                                    </div>
                                    <div>
                                        <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded">{{ ucfirst($task->status) }}</span>
                                    </div>
                                </div>
                            @empty
                                <p>No tasks found.</p>
                            @endforelse --}}
                            <h1>Tasks are shown here!</h1>
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    {{-- Add members dropdown --}}
                    <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4 text-white">Add Members</h3>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <div class="mb-4">
                                <label for="user_id" class="block font-bold text-white">Select User</label>
                                <select id="task_status" name="status" class="form-select mt-1 block w-full bg-gray-900 text-white">
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
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mt-6">
                        <h3 class="text-lg font-semibold mb-4">Group Members</h3>
                        <ul>
                            {{-- @foreach ($group->members as $member)
                                <li>{{ $member->name }}</li>
                            @endforeach --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
