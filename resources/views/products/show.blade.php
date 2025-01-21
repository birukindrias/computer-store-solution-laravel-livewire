
<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Product Details</h1>

        <div class="mb-4">
            <h2 class="text-lg font-medium">Name:</h2>
            <p>{{ $product->name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium">Price:</h2>
            <p>${{ number_format($product->price, 2) }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium">Description:</h2>
            <p>{{ $product->description }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium">QR Code:</h2>
            @if ($product->image)
<img src="{{ asset($product->image) }}" alt="QR Code" width="100" class="rounded-md shadow-sm">

            @else
                <p>No QR Code available.</p>
            @endif
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium">Error Items:</h2>
            @if ($product->checkbox_items)
                <ul class="list-disc pl-6">
                    @foreach ($product->checkbox_items as $item)
                        <li>{{ ucfirst($item) }}</li>
                    @endforeach
                </ul>
            @else
                <p>No error items selected.</p>
            @endif
        </div>

        <a href="{{ route('products.index') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Back to Products
        </a>
    </div>
</x-app-layout>
