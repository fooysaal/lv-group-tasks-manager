<!-- modal.blade.php -->

@props(['id'])

<div x-data="{ open: false }">
    <!-- Overlay -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-50"></div>

    <!-- Modal -->
    <div x-show="open" id="{{ $id }}" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white shadow-lg rounded-lg p-6 z-50">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold">{{ $title ?? 'Modal Title' }}</h2>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>

    <!-- Button to trigger the modal -->
    <button @click="open = true" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none">
        {{ $triggerText ?? 'Open Modal' }}
    </button>
</div>
