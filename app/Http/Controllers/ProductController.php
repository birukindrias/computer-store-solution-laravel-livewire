<?php

namespace App\Http\Controllers;

use App\Models\Product;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // foreach ($products as $product) {
        //     $product->qr_code_path = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('products.show', $product->id));
        // }
        // $product->save();
        foreach ($products as $product) {
            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('products.show', $product->id));

            // Save QR code as a file in the 'public/qr_codes' directory
            $fileName = 'qr_code_' . $product->id . '.svg';
            Storage::disk('public')->put('qr_codes/' . $fileName, $qrCode);

            // Update the product's qr_code_path with the file path
            $product->image = 'storage/qr_codes/' . $fileName;
            $product->save();
        }

        return view('products.index', compact('products'));
    }


    public function showProductForPrint($id)
    {
        $product = Product::findOrFail($id);

        // Return the product data as JSON, including the QR code path
        return response()->json([
            'name' => $product->name,
            'description' => $product->description,
            'image' => asset($product->image     ),
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->status; // 'fixed' or 'pending'
        $product->save();

        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }

    // Show the form to create a new product
    public function create()
    {


        return view('products.create');
    }

    // Store a newly created product
   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'qr_code' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'checkbox_items' => 'nullable|array',
            'checkbox_items.*' => 'string',
        ]);

        $product = Product::create($validated);

        if ($request->hasFile('qr_code')) {
            $path = $request->file('qr_code')->store('qr_codes', 'public');
            $product->qr_code_path = $path;
            $product->save();
        }

        $product->checkbox_items = $request->input('checkbox_items', []);
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    // Show the form to edit an existing product
    public function edit(Product $product)
    {
        $qrCode = FacadesQrCode::size(200)->generate(route('products.show', $product->id));

        return view('products.edit', compact('product', 'qrCode'));
        // return view('products.edit', compact('product'));
    }

    // Update the product in the database
    /*public function update(Request $request, Product $product)*/
    /*{*/
    /*    $request->validate([*/
    /*        'name' => 'required|string|max:255',*/
    /*        'description' => 'required|string',*/
    /*        'price' => 'required|numeric',*/
    /*        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
    /*    ]);*/
    /**/
    /*    $product->name = $request->name;*/
    /*    $product->description = $request->description;*/
    /*    $product->price = $request->price;*/
    /**/
    /*    // Handle image upload*/
    /*    if ($request->hasFile('image')) {*/
    /*        $imageName = time() . '.' . $request->image->extension();*/
    /*        $request->image->move(public_path('images'), $imageName);*/
    /*        $product->image = $imageName;*/
    /*    }*/
    /**/
    /*    $product->save();*/
    /**/
    /*    return redirect()->route('products.index')->with('success', 'Product updated successfully!');*/
    /*}*/

public function update(Request $request, Product $product)
    {
 $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'qr_code' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        'checkbox_items' => 'nullable|array',
        'checkbox_items.*' => 'string',
    ]);

    $product = Product::findOrFail($product->id);
    $product->update($validated);
      $product->checkbox_items = $request->input('checkbox_items', []);
    $product->save();$product->update([
        'name' => $request->name,
        'checkbox_items' => $request->checkbox_items,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}
    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    // Show a single product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    //
}
