<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl dark:text-white leading-tight">
                {{ __('Group') }}: {{ $group->name ?? 'No name'}}
            </h2>
            <x-link :href="route('groups.edit', $group->slug)" class="dark:bg-violet-500">
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
                    {{-- Display group members --}}
                    <div class="dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6 mt-2">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold dark:text-white">Members</h3>
                            <button onclick="toggleModal('createGroupModal')" class="bg-gray-700 dark:bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded">Invite Members</button>
                        </div>
                        <div id="createGroupModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="toggleModal('createGroupModal')">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg leading-6 font-medium dark:text-white" id="modal-title">
                                                    Invite Members
                                                </h3>
                                                <div class="mt-2">
                                                   {{-- show form to show all users and select multiple users --}}
                                                    <form action="{{ route('groups.members.add', $group->slug) }}" method="POST">
                                                          @csrf
                                                          <div class="grid grid-cols-1 gap-6">
                                                                <div class="col-span-6 sm:col-span-3">
                                                                 <label for="users" class="block text-sm font-medium dark:text-white">Select Users</label>
                                                                 <select name="users[]" id="users" multiple class="mt-1 block w-full dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:border-violet-500 dark:focus:ring-violet-500 dark:placeholder-gray-400 dark:text-gray-900 dark:placeholder-opacity-75 sm:text-sm rounded-md">
                                                                      @foreach ($users as $user)
                                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                      @endforeach
                                                                 </select>
                                                                </div>
                                                          </div>
                                                          <div class="mt-5 sm:mt-6">
                                                                <button type="submit" class="dark:bg-violet-500 dark:hover:bg-violet-600 dark:text-white font-semibold py-2 px-4 rounded">Invite</button>
                                                          </div>
                                                     </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($group->members->isNotEmpty())
                            <ul class="dark:text-white">
                                @foreach ($members as $member)
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center mb-2">
                                            @if (($member->user)->avatar)
                                                <img src="{{ Storage::url($member->user->avatar) }}" alt="{{ $member->user->name }}" class="w-8 h-8 rounded-full mr-2">
                                            @else
                                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold mr-2">
                                                    @php
                                                        $words = explode(' ', optional($member->user)->name);
                                                        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                                                        echo $initials;
                                                    @endphp
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

<script>
    function toggleModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>