<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="dark:text-white font-semibold text-xl leading-tight">
                {{ __('Groups') }}
            </h2>

            {{-- Create Group Modal Trigger --}}
            <div class="flex items-center">
                <button onclick="toggleModal('createGroupModal')" class="bg-gray-700 dark:bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Create Group</button>
            </div>
        </div>
    </x-slot>
    
    {{-- Create Group Modal --}}
    <div id="createGroupModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="toggleModal('createGroupModal')">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium dark:text-white" id="modal-title">
                                Create New Group
                            </h3>
                            <div class="mt-2">
                                <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <x-input-label for="name" :value="__('Group Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="description" :value="__('Group Description')" />
                                        <x-text-area id="description" class="block mt-1 w-full" name="description">{{ old('description') }}</x-text-area>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="image" :value="__('Group Image')" />
                                        <x-file-input id="image" class="block mt-1 " type="file" name="image" :value="old('image')" autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                    </div>
                                    <div class="mt-6">
                                        <button type="submit" class="bg-gray-500 hover:bg-green-700 text-white py-1 px-1.5 rounded">
                                            {{ __('Create Group') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($groups as $group)
                <div class="dark:bg-gray-700 rounded-lg overflow-hidden shadow-lg">
                    @if($group->image)
                        <img src="{{ Storage::url($group->image) }}" alt="{{ $group->name }}" class="w-full h-56 object-cover">
                    @else
                        <div class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-red-200 hover:to-indigo-600 text-center text-2xl font-bold text-white h-56 flex items-center justify-center">
                            {{ $group->name }}
                        </div>
                    @endif
                    <div class="p-4">
                        <h1 class="text-2xl font-semibold dark:text-white">{{ $group->name }}</h1>
                        <p class="mt-2 text-gray-400">{{ $group->description }}</p>
                        <div class="mt-4">
                            <x-link :href="route('groups.show', $group->slug)" class="text-indigo-500 hover:text-white">
                                View Group
                            </x-link>
                        </div>
                    </div>
                </div>
            @empty
                <div class="dark:bg-gray-700 rounded-lg overflow-hidden shadow-lg p-6">
                    <h1 class="text-2xl font-medium dark:text-white">You have no groups!</h1>
                    <p class="mt-4 text-gray-500 leading-relaxed">
                        You can create a group by clicking the button below.
                    </p>
                    <div class="mt-4">
                        <x-link onclick="toggleModal('createGroupModal')" class="text-indigo-500 hover:text-white">
                            Create a Group
                        </x-link>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>