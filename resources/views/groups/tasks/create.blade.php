<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-white font-semibold text-xl leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block font-bold text-white">Title</label>
                        <input type="text" name="title" id="title" class="form-input mt-1 block w-full bg-gray-900 text-white" value="{{ old('title') }}">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block font-bold text-white">Description</label>
                        <textarea name="description" id="description" class="form-textarea mt-1 block w-full bg-gray-900 text-white">{{ old('description') }}</textarea>
                    </div>
                    {{-- assigned members --}}
                    {{-- <div class="mb-4">
                        <label for="users" class="block font-bold text-white">Assign Members</label>
                        <select id="users" name="users[]" class="form-select mt-1 block w-full bg-gray-900 text-white" multiple>
                            @foreach ($group->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-4">
                        <label for="due_date" class="block font-bold text-white">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="form-input mt-1 block w-full bg-gray-900 text-white" value="{{ old('due_date') }}">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>