
<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Edit Product</h1>

        <!-- Combined Edit Form -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
            </div>

                   {{ asset($product->image) }}
            <!-- QR Code -->
            <div class="mb-4">
                <label for="qr_code" class="block text-sm font-medium text-gray-700">QR Code Image</label>
                <input type="file" name="qr_code" id="qr_code" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if($product->qr_code_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->qr_code_path) }}" alt="QR Code" class="w-24 h-24 object-cover">
                   {{ asset($product->image) }}
                   </div>
                @endif
            </div>

            <!-- Error Items -->
            @php
                $defaultItems = ['hdd', 'ram', 'battery', 'charger', 'bag', 'codeform', 'cd drive', 'board'];
                $customItems = \App\Models\ErrorItem::all();
            @endphp

            <div class="mb-4">
                <label for="checkbox_items" class="block text-sm font-medium text-gray-700">Error Items</label>
                <div class="grid grid-cols-2 gap-4 mt-2">
                    @foreach ($defaultItems as $item)
                        <div>
                            <input type="checkbox" name="checkbox_items[]" value="{{ $item }}"
                                   {{ in_array($item, $product->checkbox_items ?? []) ? 'checked' : '' }}>
                            <label>{{ ucfirst($item) }}</label>
                        </div>
                    @endforeach

                    @foreach ($customItems as $customItem)
                        <div>
                            <input type="checkbox" name="checkbox_items[]" value="{{ $customItem->name }}"
                                   {{ in_array($customItem->name, $product->checkbox_items ?? []) ? 'checked' : '' }}>
                            <label>{{ ucfirst($customItem->name) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>
