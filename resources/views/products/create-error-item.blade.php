
<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Create New Error Item</h1>

        <!-- Create Error Item Form -->
        <form action="{{ route('error-items.store') }}" method="POST">
            @csrf

            <!-- Error Item Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Error Item Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Create Error Item
            </button>
        </form>
    </div>
</x-app-layout>
