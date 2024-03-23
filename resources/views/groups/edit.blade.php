<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Group') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Group Info Section -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- Group Image -->
                        <div class="w-full h-56 overflow-hidden mb-4 object-cover">
                        @if($group->image)
                            <img src="{{ Storage::url($group->image) }}" alt="{{ $group->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-red-200 hover:to-indigo-600 text-center text-2xl font-bold text-white h-56 flex items-center justify-center">
                                {{ $group->name }}
                            </div>
                        @endif
                        </div>
                        <!-- Group Name -->
                        <h3 class="text-2xl font-semibold mb-2">{{ $group->name }}</h3>
                        <!-- Group Description -->
                        <p class="text-gray-700 dark:text-gray-300">{{ $group->description }}</p>
                    </div>
                </div>

                <!-- Update Group Form Section -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('groups.update', $group->slug) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="name" :value="__('Group Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$group->name" autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="description" :value="__('Group Description')" />
                                <x-text-area id="description" class="block mt-1 w-full" name="description" rows="5">{{ $group->description }}</x-text-area>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="image" :value="__('Group Image')" />
                                <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div class="mt-4">
                                <x-link :href="route('groups.index')" class="bg-red-500 hover:bg-red-700 dark:hover:bg-red-600">
                                    {{ __('Cancel') }}
                                </x-link>
                                <x-button class="dark:bg-blue-400 hover:bg-blue-700 dark:hover:bg-blue-600">
                                    {{ __('Update Group') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Group Section -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            {{ __('Delete Group') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your group is deleted, all of its resources and data will be permanently deleted. Before deleting your group, please download any data or information that you wish to retain.') }}
                        </p>

                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-group-deletion')"
                            class="mt-6"
                        >{{ __('Delete Group') }}</x-danger-button>

                        <x-modal name="confirm-group-deletion" :show="$errors->groupDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('groups.destroy', $group->slug) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete your group?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Once your group is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your group.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                    <x-text-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4"
                                        placeholder="{{ __('Password') }}"
                                    />

                                    <x-input-error :messages="$errors->groupDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Group') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
