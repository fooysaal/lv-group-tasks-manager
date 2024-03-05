<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Group') }}
            </h2>
            <x-link :href="route('groups.index')" class="text-cyan-400 hover:text-white bg-cyan-950">
                {{ __('Back to Groups') }}
            </x-link>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
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
                        <x-file-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>
                    <div class="flex justify-start mt-6">
                        <x-button>
                            {{ __('Create Group') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
