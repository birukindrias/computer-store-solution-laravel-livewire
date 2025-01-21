<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Products</h1>

        <!-- Add Product Button -->
        <a href="{{ route('products.create') }}"
            class="inline-block mb-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add Product
        </a>

        <!-- Products Table -->
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">QR Code</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $product->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">${{ $product->price }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <!-- @if($product->qr_code_path)
                                <img src="data:image/png;base64,{{ base64_encode($product->qr_code) }}" alt="QR Code"
                                    width="100" class="rounded-md shadow-sm">
                            @endif -->

                             <img src="{{ asset($product->image) }}" alt="QR Code" width="100" class="rounded-md shadow-sm">
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('products.show', $product->id) }}"
                                class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                View
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                Edit
                            </a>
                            <button onclick="printQRCode({{ $product->id }})" class="inline-block px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
        Print QR Code
    </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<script>
    function printQRCode(productId) {
        // Fetch the product details from the server
        fetch(`/products/${productId}/print`)
            .then(response => response.json())
            .then(product => {
                // Create a new window for printing
                const printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Print QR Code</title>');
                printWindow.document.write('<style>body { font-family: Arial, sans-serif; padding: 20px; }</style>');
                printWindow.document.write('</head><body>');

                // Add product name and description
                printWindow.document.write('<h2>' + product.name + '</h2>');
                printWindow.document.write('<p>' + product.description + '</p>');

                // Add QR code
                printWindow.document.write('<div style="margin-top: 20px;">');
                printWindow.document.write('<img src="' + product.qr_code_path + '" alt="QR Code" width="150">');
                printWindow.document.write('</div>');

                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
    }
</script>
